<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Service;
use App\Models\ServiceCheck;
use App\Models\Status;
use Illuminate\Support\Facades\Http;

class HandleServiceCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $serviceName;

    /**
     * Create a new job instance.
     *
     * @param string|null $serviceName
     */
    public function __construct(string $serviceName = null)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * Execute the job.
     * Si no hay $serviceName, despacha un job por cada servicio.
     * Si hay $serviceName, realiza el chequeo como antes.
     */
    public function handle(): void
    {
        if (!$this->serviceName) {
            // Listar todos los servicios y despachar un job por cada uno
            foreach (Service::all() as $service) {
                // Despacha un job para cada servicio
                dispatch(new self($service->name));
            }
            return;
        }

        $service = Service::where('name', $this->serviceName)->first();

        if (!$service) {
            // Servicio no encontrado, no hacer nada.
            return;
        }

        $start = microtime(true);
        try {
            $response = Http::timeout(10)->get($service->url);
            $responseTime = (microtime(true) - $start) * 1000; // ms
            $httpCode = $response->status();
            $body = $response->body();
        } catch (\Exception $e) {
            $responseTime = (microtime(true) - $start) * 1000;
            $httpCode = 0;
            $body = $e->getMessage();
        }

        // Determinar mensaje de error si existe
        $errorMessage = null;
        if ($httpCode !== 200) {
            // Si la respuesta es JSON y tiene 'message' o 'error'
            $json = json_decode($body, true);
            if (is_array($json) && (isset($json['message']) || isset($json['error']))) {
                $errorMessage = $json['message'] ?? $json['error'];
            } else {
                // Mensaje típico de error HTTP
                $errorMessage = strip_tags($body);
            }
        }

        // Guardar el check
        ServiceCheck::create([
            'service_id' => $service->id,
            'checked_at' => now(),
            'response_time' => $responseTime,
            'http_code' => $httpCode,
            'error_message' => $errorMessage,
        ]);

        // Determinar status_id según el código HTTP
        // Asumiendo los nombres del JSON de status
        if ($httpCode === 200) {
            $statusName = 'Operativo';
        } elseif ($httpCode === 404) {
            $statusName = 'Interrupción parcial';
        } elseif ($httpCode === 502 || $httpCode === 503 || $httpCode === 500) {
            $statusName = 'Interrupción mayor';
        } elseif ($httpCode === 0) {
            $statusName = 'Interrupción mayor';
        } else {
            $statusName = 'Degradado';
        }

        $status = Status::where('name', $statusName)->first();
        if ($status) {
            $service->status_id = $status->id;
        }
        $service->updated_at = now();
        $service->save();
    }
}

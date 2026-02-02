<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCheck as ModelServiceCheck;
use App\Models\Status;
use Illuminate\Support\Facades\Http;

class ServiceCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Listar todos los servicios activos y chequear cada uno
        foreach (Service::where('is_active', 1)->get() as $service) {
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
                $json = json_decode($body, true);
                if (is_array($json) && (isset($json['message']) || isset($json['error']))) {
                    $errorMessage = $json['message'] ?? $json['error'];
                } else {
                    $errorMessage = strip_tags($body);
                }
            }

            // Guardar el check
            ModelServiceCheck::create([
                'service_id' => $service->id,
                'checked_at' => now(),
                'response_time' => $responseTime,
                'http_code' => $httpCode,
                'error_message' => $errorMessage,
            ]);

            // Determinar status_id según el código HTTP
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
}

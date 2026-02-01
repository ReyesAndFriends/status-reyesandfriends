<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Status;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/services.json');
        $data = json_decode(file_get_contents($jsonPath), true);

        foreach ($data as $item) {
            $type = ServiceType::where('name', $item['service'])->first();
            $status = null;
            if (!is_null($item['status'])) {
                $status = Status::where('name', $item['status'])->first();
            }

            if (!$type) {
                Log::warning("Tipo de servicio '{$item['service']}' no encontrado. Omitiendo el servicio '{$item['name']}'.");
                continue;
            }

            Service::updateOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'] ?? null,
                    'url' => $item['url'] ?? null,
                    'is_active' => $item['is_active'] ?? true,
                    'status_id' => $status ? $status->id : null,
                    'type_id' => $type->id,
                ]
            );
        }
    }
}

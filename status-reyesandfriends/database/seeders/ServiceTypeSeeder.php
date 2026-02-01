<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceType;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/service_types.json');
        $data = json_decode(file_get_contents($jsonPath), true);

        foreach ($data as $item) {
            ServiceType::updateOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'] ?? null,
                ]
            );
        }
    }
}

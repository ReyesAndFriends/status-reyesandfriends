<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/statuses.json');
        $data = json_decode(file_get_contents($jsonPath), true);

        foreach ($data as $item) {
            Status::updateOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'] ?? null,
                    'color' => $item['color'] ?? 'bg-gray-600',
                ]
            );
        }
    }
}

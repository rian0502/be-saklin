<?php

namespace Database\Seeders;

use App\Models\MachineType;
use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Washer 7kg', 'capacity_value' => 7, 'capacity_unit' => 'kg', 'description' => 'Mesin cuci kapasitas kecil'],
            ['name' => 'Washer 14kg', 'capacity_value' => 14, 'capacity_unit' => 'kg', 'description' => 'Mesin cuci kapasitas besar'],
            ['name' => 'Dryer 10kg', 'capacity_value' => 10, 'capacity_unit' => 'kg', 'description' => 'Mesin pengering standar'],
        ];

        foreach ($types as $type) {
            MachineType::firstOrCreate(['name' => $type['name']], $type);
        }
    }
}

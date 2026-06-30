<?php

namespace Database\Seeders;

use App\Models\MachineType;
use App\Models\Outlet;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlet = Outlet::where('key', 'OUTLET-01')->first();
        $washer7 = MachineType::where('name', 'Washer 7kg')->first();
        $dryer10 = MachineType::where('name', 'Dryer 10kg')->first();

        $services = [
            // Full service (dikerjakan staff)
            [
                'name' => 'Cuci Reguler', 'price' => 7000, 'type' => 'full_service',
                'unit' => 'kg', 'duration_minutes' => 1440, 'machine_type_id' => null,
            ],
            [
                'name' => 'Cuci Express (6 jam)', 'price' => 12000, 'type' => 'full_service',
                'unit' => 'kg', 'duration_minutes' => 360, 'machine_type_id' => null,
            ],
            [
                'name' => 'Setrika Saja', 'price' => 5000, 'type' => 'full_service',
                'unit' => 'kg', 'duration_minutes' => 720, 'machine_type_id' => null,
            ],
            [
                'name' => 'Cuci + Setrika', 'price' => 9000, 'type' => 'full_service',
                'unit' => 'kg', 'duration_minutes' => 1440, 'machine_type_id' => null,
            ],
            // Self service (customer pakai mesin sendiri)
            [
                'name' => 'Self-Service Wash 7kg', 'price' => 15000, 'type' => 'self_service',
                'unit' => 'load', 'duration_minutes' => 45, 'machine_type_id' => $washer7?->id,
            ],
            [
                'name' => 'Self-Service Dry 10kg', 'price' => 10000, 'type' => 'self_service',
                'unit' => 'load', 'duration_minutes' => 60, 'machine_type_id' => $dryer10?->id,
            ],
            // Addon
            [
                'name' => 'Pewangi Premium', 'price' => 3000, 'type' => 'addon',
                'unit' => 'pcs', 'duration_minutes' => null, 'machine_type_id' => null,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['outlet_id' => $outlet->id, 'name' => $service['name']],
                [
                    ...$service,
                    'outlet_id' => $outlet->id,
                    'status' => 'active',
                ]
            );
        }
    }
}

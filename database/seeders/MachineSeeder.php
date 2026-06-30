<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\MachineType;
use App\Models\Outlet;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlet = Outlet::where('key', 'OUTLET-01')->first();

        $washer7 = MachineType::where('name', 'Washer 7kg')->first();
        $washer14 = MachineType::where('name', 'Washer 14kg')->first();
        $dryer10 = MachineType::where('name', 'Dryer 10kg')->first();

        $machines = [
            ['key' => 'MCH-001', 'name' => 'Washer Unit 1', 'type' => 'washer', 'machine_type_id' => $washer7->id],
            ['key' => 'MCH-002', 'name' => 'Washer Unit 2', 'type' => 'washer', 'machine_type_id' => $washer7->id],
            ['key' => 'MCH-003', 'name' => 'Washer Unit 3 (Besar)', 'type' => 'washer', 'machine_type_id' => $washer14->id],
            ['key' => 'MCH-004', 'name' => 'Dryer Unit 1', 'type' => 'dryer', 'machine_type_id' => $dryer10->id],
            ['key' => 'MCH-005', 'name' => 'Dryer Unit 2', 'type' => 'dryer', 'machine_type_id' => $dryer10->id],
        ];

        foreach ($machines as $machine) {
            Machine::firstOrCreate(
                ['key' => $machine['key']],
                [
                    ...$machine,
                    'outlet_id' => $outlet->id,
                    'status' => 'idle',
                ]
            );
        }
    }
}

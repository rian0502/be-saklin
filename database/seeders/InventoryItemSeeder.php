<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\Outlet;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlet = Outlet::where('key', 'OUTLET-01')->first();

        $items = [
            ['name' => 'Deterjen Cair', 'unit' => 'liter', 'unit_cost' => 25000, 'current_stock' => 50, 'reorder_point' => 10],
            ['name' => 'Pewangi Pakaian', 'unit' => 'liter', 'unit_cost' => 30000, 'current_stock' => 30, 'reorder_point' => 8],
            ['name' => 'Plastik Packing', 'unit' => 'pcs', 'unit_cost' => 500, 'current_stock' => 500, 'reorder_point' => 100],
            ['name' => 'Hanger', 'unit' => 'pcs', 'unit_cost' => 2000, 'current_stock' => 200, 'reorder_point' => 50],
        ];

        foreach ($items as $item) {
            InventoryItem::firstOrCreate(
                ['outlet_id' => $outlet->id, 'name' => $item['name']],
                [...$item, 'outlet_id' => $outlet->id]
            );
        }
    }
}

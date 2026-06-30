<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            TenantOutletSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            MachineTypeSeeder::class,
            MachineSeeder::class,
            ServiceSeeder::class,
            InventoryItemSeeder::class,
            PromotionSeeder::class,
        ]);
    }
}

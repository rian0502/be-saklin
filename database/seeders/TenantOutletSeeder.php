<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantOutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::firstOrCreate(
            ['name' => 'Saklin Laundry'],
            [
                'contract' => 'Default Contract',
                'phone' => '021-1234567',
                'email' => 'owner@saklin.test',
                'status' => 'active',
            ]
        );

        Outlet::firstOrCreate(
            ['key' => 'OUTLET-01'],
            [
                'tenant_id' => $tenant->id,
                'name' => 'Outlet Pusat',
                'address' => 'Jl. Contoh No. 1',
                'phone' => '021-7654321',
                'status' => 'active',
            ]
        );
    }
}

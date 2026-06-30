<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlet = Outlet::where('key', 'OUTLET-01')->first();

        $owner = User::firstOrCreate(
            ['email' => 'owner@saklin.test'],
            [
                'outlet_id' => $outlet->id,
                'name' => 'Owner Saklin',
                'password' => Hash::make('password123'),
                'status' => 'active',
            ]
        );

        if (! $owner->hasRole('owner')) {
            $owner->assignRole('owner');
        }

        $cashier = User::firstOrCreate(
            ['email' => 'cashier@saklin.test'],
            [
                'outlet_id' => $outlet->id,
                'name' => 'Kasir Outlet 1',
                'password' => Hash::make('password123'),
                'status' => 'active',
            ]
        );

        if (! $cashier->hasRole('cashier')) {
            $cashier->assignRole('cashier');
        }
    }
}

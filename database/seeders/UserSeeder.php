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
        $outlet = Outlet::where('key', 'OUTLET-01')->firstOrFail();

        $users = [
            [
                'name' => 'Owner Saklin',
                'email' => 'owner@saklin.test',
                'role' => 'owner',
            ],
            [
                'name' => 'Manager Outlet 1',
                'email' => 'manager@saklin.test',
                'role' => 'outlet_manager',
            ],
            [
                'name' => 'Kasir Outlet 1',
                'email' => 'cashier@saklin.test',
                'role' => 'cashier',
            ],
            [
                'name' => 'Staff Outlet 1',
                'email' => 'staff@saklin.test',
                'role' => 'staff',
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'outlet_id' => $outlet->id,
                    'name' => $data['name'],
                    'password' => Hash::make('password123'),
                    'status' => 'active',
                ]
            );

            $user->syncRoles([$data['role']]);
        }
    }
}
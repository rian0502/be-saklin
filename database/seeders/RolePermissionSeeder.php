<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = 'api';

        $permissions = [

            // Dashboard
            'dashboard.view',

            // Master
            'customers.view',
            'customers.create',
            'customers.update',
            'customers.delete',

            'services.view',
            'services.create',
            'services.update',
            'services.delete',

            'machines.view',
            'machines.create',
            'machines.update',
            'machines.delete',

            'outlets.view',
            'outlets.create',
            'outlets.update',
            'outlets.delete',

            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            // Transaction
            'orders.view',
            'orders.create',
            'orders.update',
            'orders.cancel',

            'payments.view',
            'payments.create',

            // Inventory
            'inventory.view',
            'inventory.create',
            'inventory.update',
            'inventory.delete',

            // Promotion
            'promotions.view',
            'promotions.create',
            'promotions.update',
            'promotions.delete',

            // Report
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guard,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Owner
        |--------------------------------------------------------------------------
        */

        $owner = Role::firstOrCreate([
            'name' => 'owner',
            'guard_name' => $guard,
        ]);

        $owner->syncPermissions(
            Permission::where('guard_name', $guard)->get()
        );

        /*
        |--------------------------------------------------------------------------
        | Outlet Manager
        |--------------------------------------------------------------------------
        */

        $manager = Role::firstOrCreate([
            'name' => 'outlet_manager',
            'guard_name' => $guard,
        ]);

        $manager->syncPermissions([
            'dashboard.view',

            'customers.view',
            'customers.create',
            'customers.update',

            'services.view',
            'services.create',
            'services.update',

            'machines.view',
            'machines.create',
            'machines.update',

            'orders.view',
            'orders.create',
            'orders.update',
            'orders.cancel',

            'payments.view',
            'payments.create',

            'inventory.view',
            'inventory.create',
            'inventory.update',

            'promotions.view',
            'promotions.create',
            'promotions.update',

            'reports.view',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Cashier
        |--------------------------------------------------------------------------
        */

        $cashier = Role::firstOrCreate([
            'name' => 'cashier',
            'guard_name' => $guard,
        ]);

        $cashier->syncPermissions([
            'dashboard.view',

            'customers.view',
            'customers.create',

            'orders.view',
            'orders.create',

            'payments.view',
            'payments.create',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Staff
        |--------------------------------------------------------------------------
        */

        $staff = Role::firstOrCreate([
            'name' => 'staff',
            'guard_name' => $guard,
        ]);

        $staff->syncPermissions([
            'dashboard.view',

            'inventory.view',
            'inventory.update',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
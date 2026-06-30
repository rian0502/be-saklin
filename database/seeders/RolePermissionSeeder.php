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
        app(PermissionRegistrar::class)->setPermissionsTeamId(null);

        $guard = 'api';

        $permissions = [
            'manage-outlets', 'manage-machines', 'manage-services',
            'manage-inventory', 'create-orders', 'void-orders',
            'manage-payments', 'manage-promotions',
            'view-reports', 'manage-users',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => $guard]);
        }

        $owner = Role::firstOrCreate(['name' => 'owner', 'guard_name' => $guard]);
        $owner->givePermissionTo(Permission::where('guard_name', $guard)->get());

        $outletManager = Role::firstOrCreate(['name' => 'outlet_manager', 'guard_name' => $guard]);
        $outletManager->givePermissionTo([
            'manage-machines', 'manage-services', 'manage-inventory',
            'create-orders', 'void-orders', 'manage-payments',
            'manage-promotions', 'view-reports',
        ]);

        $cashier = Role::firstOrCreate(['name' => 'cashier', 'guard_name' => $guard]);
        $cashier->givePermissionTo(['create-orders', 'manage-payments']);

        $staff = Role::firstOrCreate(['name' => 'staff', 'guard_name' => $guard]);
        $staff->givePermissionTo(['manage-inventory']);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}

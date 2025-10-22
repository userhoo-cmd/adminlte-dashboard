<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🧹 Clear cache to avoid duplication issues
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --------------------------------------------------------
        // 1️⃣ Define all system permissions
        // --------------------------------------------------------
        $permissions = [
            // General access
            'view dashboard',

            // Product & sales management
            'manage products',
            'manage orders',
            'manage sales',
            'manage payments',

            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // --------------------------------------------------------
        // 2️⃣ Define roles & assign permissions
        // --------------------------------------------------------
        $roles = [
            'superadmin' => $permissions, // All permissions
            'admin' => [
                'view dashboard',
                'manage products',
                'manage orders',
                'manage sales',
                'view users',
                'edit users',
            ],
            'staff' => [
                'view dashboard',
                'manage orders',
                'manage sales',
            ],
            'user' => [
                'view dashboard',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateUsersWithRolesSeeder extends Seeder
{
    public function run(): void
    {
        // 🧱 1️⃣ Ensure roles exist
        $roles = ['superadmin', 'admin', 'user'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 🧱 2️⃣ Create default users
        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password123'),
                'avatar' => 'avatars/default.png',
                'role' => 'superadmin',
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'avatar' => 'avatars/default.png',
                'role' => 'admin',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password123'),
                'avatar' => 'avatars/default.png',
                'role' => 'user',
            ],
        ];

        // 🧱 3️⃣ Insert users and assign roles
        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'password' => $data['password'],
                    'avatar' => $data['avatar'],
                ]
            );

            $user->syncRoles($data['role']);
        }
    }
}

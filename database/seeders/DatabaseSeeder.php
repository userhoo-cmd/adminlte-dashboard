<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1️⃣ Create or update the default admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'password' => Hash::make('password123'), // Login password
                'is_admin' => 1,
                'role' => 'admin',
                'avatar' => null, // optional
            ]
        );

        // 2️⃣ Optionally, create/update a normal user
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'password' => Hash::make('user123'), // Login password
                'is_admin' => 0,
                'role' => 'user',
                'avatar' => null,
            ]
        );
    }
}

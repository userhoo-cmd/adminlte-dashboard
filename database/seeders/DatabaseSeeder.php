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
        // ✅ Call your role + user seeder
        $this->call(CreateUsersWithRolesSeeder::class);

        // ✅ Optionally: extra demo users (won’t conflict)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
                'role' => 'admin',
                'avatar' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
                'role' => 'user',
                'avatar' => null,
            ]
        );
    }
}

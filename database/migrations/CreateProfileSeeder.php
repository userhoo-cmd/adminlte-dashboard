<?php
use Illuminate\Database\Seeder;
use App\Models\Profile;

class CreateProfileSeeder extends Seeder
{
    public function run()
    {
        // Add any necessary data for profiles
        Profile::create([
            'user_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'bio' => 'Sample bio',
            'avatar' => 'default-avatar.png',
        ]);
    }
}

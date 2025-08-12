<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample users
        User::create([
            'name' => 'Wildan Miladji',
            'email' => 'wildan@example.com',
            'phone' => '08123456789',
            'is_active' => true,
            'department' => 'Backend Developer',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '08987654321',
            'is_active' => true,
            'department' => 'IT',
            'password' => bcrypt('admin123'),
        ]);

        // Create additional random users
        User::factory(8)->create();
    }
}
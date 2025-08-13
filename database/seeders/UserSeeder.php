<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Wildan Miladji',
                'email' => 'wildan@example.com',
                'phone' => '08123456789',
                'is_active' => true,
                'department' => 'Backend Developer',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@company.com',
                'phone' => '08567891234',
                'is_active' => true,
                'department' => 'Frontend Developer',
                'password' => bcrypt('sarah123'),
            ],
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@company.com',
                'phone' => '08234567890',
                'is_active' => true,
                'department' => 'DevOps Engineer',
                'password' => bcrypt('ahmad123'),
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@company.com',
                'phone' => '08345678901',
                'is_active' => false,
                'department' => 'UI/UX Designer',
                'password' => bcrypt('maria123'),
            ],
            [
                'name' => 'David Chen',
                'email' => 'david.chen@company.com',
                'phone' => '08456789012',
                'is_active' => true,
                'department' => 'Product Manager',
                'password' => bcrypt('david123'),
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.anderson@company.com',
                'phone' => '08678901234',
                'is_active' => true,
                'department' => 'QA Engineer',
                'password' => bcrypt('lisa123'),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@company.com',
                'phone' => '08789012345',
                'is_active' => true,
                'department' => 'System Administrator',
                'password' => bcrypt('budi123'),
            ],
            [
                'name' => 'Jennifer Lee',
                'email' => 'jennifer.lee@company.com',
                'phone' => '08890123456',
                'is_active' => false,
                'department' => 'Business Analyst',
                'password' => bcrypt('jennifer123'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
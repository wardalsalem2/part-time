<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Ahmad', 'email' => 'ahmad@example.com', 'password' => '12345678', 'role_id' => 1], // User
            ['name' => 'SaraCompany', 'email' => 'sara@company.com', 'password' => '12345678', 'role_id' => 2], // Company
            ['name' => 'AliCompany', 'email' => 'ali@company.com', 'password' => '12345678', 'role_id' => 2], // Company
            ['name' => 'Khaled', 'email' => 'khaled@example.com', 'password' => '12345678', 'role_id' => 3], // Admin
            ['name' => 'Mona', 'email' => 'mona@example.com', 'password' => '12345678', 'role_id' => 1],
            ['name' => 'Yousef', 'email' => 'yousef@example.com', 'password' => '12345678', 'role_id' => 1],
            ['name' => 'Lina', 'email' => 'lina@example.com', 'password' => '12345678', 'role_id' => 1],
            ['name' => 'Omar', 'email' => 'omar@example.com', 'password' => '12345678', 'role_id' => 1],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'role_id' => $user['role_id'],
            ]);
        }
    }
}

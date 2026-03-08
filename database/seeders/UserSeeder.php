<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'full_name' => 'Admin User',
            'email' => 'admin@civicportal.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '9999999999',
        ]);

        User::create([
            'full_name' => 'Soham Citizen',
            'email' => 'citizen@civicportal.com',
            'password' => Hash::make('password123'),
            'role' => 'citizen',
            'phone' => '8888888888',
        ]);

        User::create([
            'full_name' => 'Rushikesh Worker',
            'email' => 'worker@civicportal.com',
            'password' => Hash::make('password123'),
            'role' => 'worker',
            'phone' => '7777777777'
        ]);
    }
}

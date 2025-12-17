<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'role' => 'admin'
            ]
        );

        // Technician
        User::updateOrCreate(
            ['email' => 'tech@gmail.com'],
            [
                'name' => 'Tech',
                'password' => Hash::make('123456'),
                'role' => 'technician'
            ]
        );

        // Customer
        User::updateOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Customer',
                'password' => Hash::make('123456'),
                'role' => 'customer'
            ]
        );
    }
}

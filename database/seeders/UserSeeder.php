<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'L',
            ],
            [
                'name' => 'Ani Wijaya',
                'email' => 'ani@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'P',
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'P',
            ],
            [
                'name' => 'Dodi Pratama',
                'email' => 'dodi@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'L',
            ],
            [
                'name' => 'Eva Susanti',
                'email' => 'eva@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'P',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 
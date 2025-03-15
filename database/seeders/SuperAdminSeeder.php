<?php

namespace Database\Seeders;

use App\Models\Superadmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        Superadmin::create([
            'name' => 'Aden',
            'email' => 'aden@super',
            'password' => Hash::make('password123'),
            'phone' => '6282159571001',
            'status' => 'active',
        ]);
    }
} 
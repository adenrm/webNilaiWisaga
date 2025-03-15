<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Study;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Pak Bambang',
                'email' => 'bambang@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'L',
                'subjects' => ['MTK'], // Kode mata pelajaran
            ],
            [
                'name' => 'Bu Siti',
                'email' => 'siti@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'P',
                'subjects' => ['BIN'],
            ],
            [
                'name' => 'Mr. John',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'L',
                'subjects' => ['BIG'],
            ],
            [
                'name' => 'Bu Ratna',
                'email' => 'ratna@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'P',
                'subjects' => ['IPA'],
            ],
            [
                'name' => 'Pak Dedi',
                'email' => 'dedi@example.com',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'gender' => 'L',
                'subjects' => ['IPS'],
            ],
        ];

        foreach ($admins as $adminData) {
            $subjects = $adminData['subjects'];
            unset($adminData['subjects']);
            
            $admin = Admin::create($adminData);

            // Attach subjects to admin with study name
            $studies = Study::whereIn('code', $subjects)->get();
            foreach ($studies as $study) {
                $admin->studies()->attach($study->id, [
                    'study_name' => $study->name,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
} 
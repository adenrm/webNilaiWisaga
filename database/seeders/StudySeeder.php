<?php

namespace Database\Seeders;

use App\Models\Study;
use Illuminate\Database\Seeder;

class StudySeeder extends Seeder
{
    public function run(): void
    {
        $studies = [
            [
                'name' => 'Matematika',
                'code' => 'MTK',
                'description' => 'Pelajaran Matematika',
                'status' => 'active',
            ],
            [
                'name' => 'Bahasa Indonesia',
                'code' => 'BIN',
                'description' => 'Pelajaran Bahasa Indonesia',
                'status' => 'active',
            ],
            [
                'name' => 'Bahasa Inggris',
                'code' => 'BIG',
                'description' => 'Pelajaran Bahasa Inggris',
                'status' => 'active',
            ],
            [
                'name' => 'Ilmu Pengetahuan Alam',
                'code' => 'IPA',
                'description' => 'Pelajaran IPA',
                'status' => 'active',
            ],
            [
                'name' => 'Ilmu Pengetahuan Sosial',
                'code' => 'IPS',
                'description' => 'Pelajaran IPS',
                'status' => 'active',
            ],
        ];

        foreach ($studies as $study) {
            Study::create($study);
        }
    }
} 
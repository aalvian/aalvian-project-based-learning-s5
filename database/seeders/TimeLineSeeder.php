<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('time_lines')->insert([
            [
                'nama' => 'Gelombang Pertama',
                'waktu_mulai' => '2024-10-10',
                'waktu_berakhir' => '2025-11-15',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gelombang Kedua',
                'waktu_mulai' => '2025-01-01',
                'waktu_berakhir' => '2025-01-20',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

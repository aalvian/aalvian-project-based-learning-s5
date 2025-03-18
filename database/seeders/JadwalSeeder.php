<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwals')->insert([
            [
                'hari' => 'Senin',
                'waktu_mulai' => '15:30:00',
                'waktu_selesai' => '17:00:00',
                'aktifasi' => 1,
                'id_divisi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Selasa',
                'waktu_mulai' => '15:30:00',
                'waktu_selesai' => '17:00:00',
                'aktifasi' => 1,
                'id_divisi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Rabu',
                'waktu_mulai' => '15:30:00',
                'waktu_selesai' => '17:00:00',
                'aktifasi' => 0,
                'id_divisi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Kamis',
                'waktu_mulai' => '15:30:00',
                'waktu_selesai' => '17:00:00',
                'aktifasi' => 0,
                'id_divisi' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Jumat',
                'waktu_mulai' => '16:00:00',
                'waktu_selesai' => '17:00:00',
                'aktifasi' => 0,
                'id_divisi' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Sabtu',
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '11:00:00',
                'aktifasi' => 0,
                'id_divisi' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Sabtu',
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '11:00:00',
                'aktifasi' => 0,
                'id_divisi' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Sabtu',
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '11:00:00',
                'aktifasi' => 0,
                'id_divisi' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Sabtu',
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '11:00:00',
                'aktifasi' => 0,
                'id_divisi' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Sabtu',
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '11:00:00',
                'aktifasi' => 0,
                'id_divisi' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'hari' => 'Sabtu',
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '11:00:00',
                'aktifasi' => 0,
                'id_divisi' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

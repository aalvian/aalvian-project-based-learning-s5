<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('presensis')->insert([
            [
                'tanggal' => '2024-10-10',
                'bukti' => null,
                'id_anggota' => 2,
                'id_divisi'=> 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

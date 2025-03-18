<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alats')->insert([
            [
                'nama_alat' => 'Shuttleshock',
                'stok' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Bola Fustal',
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Raket Tenis',
                'stok' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            [
                'nama' => 'Pengurus Harian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

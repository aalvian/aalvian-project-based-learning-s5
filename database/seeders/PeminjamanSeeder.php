<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peminjamans')->insert([
            [
                'jml_alat' => 2,
                'tggl_pinjam' => '2024-10-05',
                'petugas_id' => 1,
                'id_alat' => 1,
                'id_anggota' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

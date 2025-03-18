<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiHasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisi_has_anggotas')->insert([            
            [
                'id_divisi' => 3,
                'id_anggota' => 1,
            ],
            [
                'id_divisi' => 4,
                'id_anggota' => 1,
            ],            
            [
                'id_divisi' => 4,
                'id_anggota' => 2,
            ],            
            [
                'id_divisi' => 5,
                'id_anggota' => 2,
            ],            
        ]);
    }
}

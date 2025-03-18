<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anggotas')->insert([
            [
                'nama' => 'Admin',
                'nim' => '362258302111',
                'email' => 'adminukm@gmail.com',
                'semester' => '3',
                'no_telp' => '081234567890',
                'cv' => null,
                'status' => 'diterima',
                'id_prodi' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],           
            [
                'nama' => 'Anggota',
                'nim' => '362910229320',
                'email' => 'testanggota2@gmail.com',
                'semester' => '3',
                'no_telp' => '081234567890',
                'cv' => null,
                'status' => 'ditolak',
                'id_prodi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

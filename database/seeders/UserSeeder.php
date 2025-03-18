<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $anggotaDiterima = Anggota::where('status', 'diterima')->get();

        foreach ($anggotaDiterima as $anggota) {      
            DB::table('users')->insert([                            
                'id_anggota' => $anggota->id_anggota,
                'email' => $anggota->email,
                'password' => Hash::make('password'),                
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

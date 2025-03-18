<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodis')->insert([
            [                
                'nama' => 'Manajemen Bisnis Pariwisata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Destinasi Pariwisata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Pengelolaan Perhotelan',
                'created_at' => now(),
                'updated_at' => now(),
            ],        
            [                
                'nama' => 'Agribisnis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [               
                'nama' => 'Teknologi Pengolahan Hasil Ternak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Budidaya Perikanan / Akuakultur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Produksi Tanaman Pangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Produksi Ternak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknik Sipil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Rekayasa Konstruksi Jalan dan Jembatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Rekayasa Manufaktur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknik Manufaktur Kapal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Rekayasa Perangkat Lunak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Bisnis Digital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'nama' => 'Teknologi Rekayasa Komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisis')->insert([
            [
                'nama' => 'Futsal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Volly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bulu Tangkis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'E-Sport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pencak Silat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Basket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Karate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Catur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Taekwondo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tenis Meja',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
            [
                'nama' => 'None',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
        ]);
    }
}

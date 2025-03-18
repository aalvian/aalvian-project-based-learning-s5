<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;

    public function definition()
{
    return [
        'nama' => $this->faker->name,
        'nim' => $this->faker->unique()->numerify('36222######'),
        'email' => 'testing@gmail.com',
        'semester' => $this->faker->numberBetween(1, 3),
        'no_telp' => $this->faker->phoneNumber,
        'cv' => $this->faker->file('C:/Users/acer/Downloads', storage_path('app/public/cv'), false),
        'status' => 'diterima',
        'id_prodi' => 13,
    ];
}

}

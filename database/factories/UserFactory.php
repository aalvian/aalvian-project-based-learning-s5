<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [

            'email' => 'testing@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'token' => Str::random(10),

        ];
    }
//     protected $model = User::class;

//     public function definition()
// {
//     // dd($anggota->id_anggota); // Periksa apakah ada duplikasi

//     return [
//         'id_anggota' => $anggota->id_anggota,
//         'gambar' => null, 
//         'email' => $this->faker->unique()->safeEmail,
//         'password' => bcrypt('password'), 
//         'current_role_id' => null, 
//         'token' => Str::random(10),
//     ];
// }

}


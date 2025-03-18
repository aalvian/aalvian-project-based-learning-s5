<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';
    protected $primaryKey = "id_prodi";
    protected $fillable = [
        'nama',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_prodi', 'id_prodi');
    }

}

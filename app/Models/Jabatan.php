<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';
    protected $primaryKey = "id_jabatan";
    protected $fillable = [
        'nama',
    ];

    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'jabatan_has_anggota', 'id_jabatan', 'id_anggota');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $primaryKey = "id_peminjaman";
    protected $fillable = [
        'id_anggota',
        'id_alat',
        'jml_alat',
        'tggl_pinjam',
        'petugas_id'
    ];


     // Method yang menangani peminjaman kitaaaa
     public static function pinjam($data)
     {
        $validatedData = $data->validate([
            'id_anggota'=>'required',
            'id_alat' => 'required|exists:alats,id_alat',
            'jml_alat' => 'required|integer|min:1',
            'tggl_pinjam' => 'required|date',
        ]);
            $validatedData['petugas_id'] = auth()->user()->id_user;
         // melihat alat bedasarkan id
         $alat = Alat::where('id_alat', $data['id_alat'])->firstOrFail();
         
         // memeriksa stok
         $alat->kurangStok($data['jml_alat']);

 
         // buat peminjaman
         return self::create([
             'id_anggota' => $validatedData['id_anggota'],
             'id_alat' => $validatedData['id_alat'],
             'jml_alat' => $validatedData['jml_alat'],
             'tggl_pinjam' => $validatedData['tggl_pinjam'],
             'petugas_id' => $validatedData['petugas_id'],
             'status' => 'dipinjam',
         ]);
     }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjaman');
    }


}
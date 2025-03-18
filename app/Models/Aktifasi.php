<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Aktifasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_aktifasi';
    protected $fillable = [
        // 'id_aktifasi',
        'tenggat',
        'status',
        'pertemuan',
        'tanggal',
        'jadwal_id'
    ];

    public function jadwal(){
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id_jadwal');
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'aktifasi_id', 'id_aktifasi');
    }
    
    
    public static function takeAktifasi(){
        $user = Auth::user();
        $id = $user->id_user;
        $anggota = Anggota::where('id_anggota', $id)->first();
        $divisi = $anggota->divisi->pluck('id_divisi');
        $namaDivisi1 = Divisi::where('id_divisi',$divisi[0])->get();
        // dd($divisi);
        $namaDivisi2 = Divisi::where('id_divisi',$divisi[1])->get();
        $id_jadwal1 = Jadwal::where('id_divisi', $divisi[0])->first();
        $id_jadwal2 = Jadwal::where('id_divisi', $divisi[1])->first();
        $aktifasi1 = Aktifasi::where('jadwal_id', $id_jadwal1->id_jadwal)->get();
        $aktifasi2 = Aktifasi::where('jadwal_id', $id_jadwal2->id_jadwal)->get();
        
        foreach ($aktifasi1 as $item) {
            $item->nama = $namaDivisi1[0]->nama;
            $item->id_divisi = $namaDivisi1[0]->id_divisi;
        }
        
        // Tambahkan nama divisi ke setiap item dalam koleksi aktifasi2
        foreach ($aktifasi2 as $item) {
            $item->nama = $namaDivisi2[0]->nama;
            $item->id_divisi = $namaDivisi2[0]->id_divisi;
        }
        // return $aktifasi1;
        return [
            0 => $aktifasi1,
            1 => $aktifasi2,
        ];
    }
}

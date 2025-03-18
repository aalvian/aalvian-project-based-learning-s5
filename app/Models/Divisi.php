<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';
    protected $primaryKey = "id_divisi";
    protected $fillable = [
        'id_divisi',
        'nama',
    ];
    public function anggota()
    {
        return $this->belongsToMany(Anggota::class, 'divisi_has_anggotas', 'id_divisi', 'id_anggota');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_divisi', 'id_divisi');
    }
    public static function hapusDivisiNoneDiDataJadwal($dtJadwal){
        // dd($dtJadwal);
        $length = count($dtJadwal);
        for ($i = 0; $i<$length; $i++){//untuk menghilangkan divisi_id 11 dari data jadwal
            if($dtJadwal[$i]->nama == 'None'){
                unset($dtJadwal[$i]);
            }

        }
    }

    public static function ViewDivisi()
    {
        // $user = auth()->user();
            // $logName = $user->name;
            // activity()->inLog($logName)->log('membuka alat');
        $dtDivisi = Divisi::Orderby('id_divisi')->paginate(12);
        Divisi::hapusDivisiNoneDiDataJadwal($dtDivisi);
        // dd($dtDivisi);
        return $dtDivisi;
    }

    public static function Tambah(Request $request)
{
    $request->validate([
        'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/']
    ], [
        'nama.required' => 'Nama tidak boleh kosong.',
        'nama.regex' => 'Nama tidak boleh mengandung angka atau karakter khusus.'
    ]);

    Divisi::create([
        'nama' => $request->nama,
    ]);
    // $user = auth()->user();
    //     $logName = $user->name;
    //     activity()->inLog($logName)->log('menambah divisi');
    return $request;
}
    public static function temukan($id_divisi)
    {
        $divisis = Divisi::findOrFail($id_divisi);
        return $divisis;
    }

    public static function edit(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/']
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.regex' => 'Nama tidak boleh mengandung angka atau karakter khusus.'
        ]);

        $divisis = Divisi::findOrFail($id);
        $divisis->update($request->all());
        // $user = auth()->user();
        // $logName = $user->name;
        // activity()->inLog($logName)->log('mengedit divisi');
        return $divisis;
    }

    public static function hapus($id_divisi)
    {
        $divisis = Divisi::findOrFail($id_divisi);
        $divisis->delete();
        // $user = auth()->user();
        // $logName = $user->name;
        // activity()->inLog($logName)->log('menambah divisi');
        return $divisis;
    }
}
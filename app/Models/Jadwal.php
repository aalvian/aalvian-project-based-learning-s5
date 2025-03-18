<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $primaryKey = "id_jadwal";
    protected $fillable = [
        'id_jadwal',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'tenggat',
        'aktifasi',
        'id_divisi'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
    public function aktifasi(){
        return $this->hasMany(Aktifasi::class, 'jadwal_id', 'id_jadwal');
    }
    public function getAktifasiAttribute($value)
    {
        $currentTime = Carbon::now()->format('H:i:00'); // Waktu saat ini (jam:menit)
        $tenggat = $this->tenggat; // Ambil waktu tenggat dari database

        // Jika waktu saat ini sudah melewati tenggat, aktifasi otomatis jadi 0
        if ($currentTime > $tenggat) {
            $this->attributes['aktifasi'] = 0; // Ubah status di memori model
            $this->save(); // Simpan perubahan ke database
            return 0;
        }

        return $value; // Kembalikan status aktifasi asli jika belum lewat tenggat
    }

    public static function viewJadwal(){
        $dtJadwal = Jadwal::all();
        Divisi::hapusDivisiNoneDiDataJadwal($dtJadwal);
        $user = auth()->user();
        $logName = $user->name;
        activity()->inLog($logName)->log('mengakses jadwal');
        return view ('admin.jadwal.index', compact('dtJadwal'));
    }

    public static function createJadwal(Request $request){
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'waktu_mulai'  => 'required|date_format:H:i',
            'waktu_selesai'  => 'required|date_format:H:i|after:waktu_mulai',
            'id_divisi'=>'required',
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);
    
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if($request->id_divisi != 12){

            Jadwal::create([
                'hari' => $request->hari,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'id_divisi' => $request->id_divisi,
            ]);
        }
        else{
            return redirect('jadwal')->with('error', 'Divisi None tidak boleh memiliki jadwal');
        }
    
        $user = auth()->user();
        $logName = $user->name;
        activity()->inLog($logName)->log('create jadwal');
        return redirect('jadwal')->with('toast_success', 'Data Berhasil Disimpan');
    }
    
    public static function viewEditJadwal($id){
        $id = decrypt($id);
        $jadwals = Jadwal::findOrFail($id);
        $divisis = Divisi::all();
        return view('admin.jadwal.edit', compact('jadwals', 'divisis'));
    }

    public static function updateJadwal(Request $request, string $id){
        $jadwals = Jadwal::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'waktu_mulai'  => 'required|date_format:H:i',
            'waktu_selesai'  => 'required|date_format:H:i|after:waktu_mulai',
            'id_divisi'=>'required'
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $jadwals->update($request->all());
        $user = auth()->user();
        $logName = $user->name;
        activity()->inLog($logName)->log('mengedit jadwal');
        return redirect('jadwal')->with('toast_success', 'Data Berhasil Diubah');
    }

    public static function dropJadwal($id){
        $jadwals = Jadwal::findOrFail($id);
        $jadwals->delete();
        $user = auth()->user();
        $logName = $user->name;
        activity()->inLog($logName)->log('menghapus jadwal');
        return back()->with('toast_success', 'Data Berhasil Dihapus');
    }

}

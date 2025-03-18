<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';
    protected $primaryKey = "id_presensi";
    protected $fillable = [
        'id_presensi',
        'tanggal',
        'bukti',
        'id_anggota',
        'id_divisi',
        'aktifasi_id'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
    public function aktifasirelation()
    {
        return $this->belongsTo(Aktifasi::class, 'aktifasi_id', 'id_aktifasi');
    }


    public static function cetakPresensi(Request $request){
        $query = Presensi::with(['divisi', 'anggota']);
        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }
        $data = $query->get();
        
        foreach ($data as $item) {
            $item['nama_divisi'] = $item->divisi ? $item->divisi->nama : 'Tidak diketahui';
            $item['nama_anggota'] = $item->anggota ? $item->anggota->nama : 'Tidak diketahui';
            $item['pertemuan'] = $item->aktifasirelation ? $item->aktifasirelation->pertemuan : 'Tidak diketahui';
        }
        // dd($data);
        return $data;
    }

    public static function cetakPresensiFilter(Request $request, $status){
        $query = Presensi::with(['divisi', 'anggota'])->where('status', $status);
        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }
        $data = $query->get();
        
        foreach ($data as $item) {
            $item['nama_divisi'] = $item->divisi ? $item->divisi->nama : 'Tidak diketahui';
            $item['nama_anggota'] = $item->anggota ? $item->anggota->nama : 'Tidak diketahui';
            $item['pertemuan'] = $item->aktifasirelation ? $item->aktifasirelation->pertemuan : 'Tidak diketahui';
        }
        // dd($data);
        return $data;
    }



    public static function detail_presensi($id){
        $data = Presensi::with(['divisi', 'anggota'])->where('id_presensi', $id)->first();
        $data['nama_divisi'] = $data->divisi ? $data->divisi->nama : 'Tidak diketahui';
        $data['nama_anggota'] = $data->anggota ? $data->anggota->nama : 'Tidak diketahui';
        $data['pertemuan'] = $data->aktifasirelation ? $data->aktifasirelation->pertemuan : 'Tidak diketahui';
        unset($data['id_divisi'], $data['aktifasi_id'], $data['id_anggota']);
        // dd($data);
        return view('content.presensi.detail', compact('data'));
        // return $data;
    }

    public static function dataPresensi(){
        $data = Presensi::with(['divisi', 'anggota'])->get();
    foreach ($data as $item) {
        $item['nama_divisi'] = $item->divisi ? $item->divisi->nama : 'Tidak diketahui';
        $item['nama_anggota'] = $item->anggota ? $item->anggota->nama : 'Tidak diketahui';
        $item['pertemuan'] = $item->aktifasirelation ? $item->aktifasirelation->pertemuan : 'Tidak diketahui';
        unset($item['id_divisi'], $item['aktifasi_id'], $item['id_anggota']);
    }
    // dd($data);
    return view('content.presensi.show', compact('data'));
    }

    public static function store(Request $request){
        $user = Auth()->user();
        $anggota = $user->anggota;
        $idDivisi = $anggota->divisi->pluck('id_divisi');

        $data_jadwal = Jadwal::whereIn('id_divisi', $idDivisi)->first();
        $tenggat = $data_jadwal->waktu_selesai;
        // dd($request);
        $validator = Validator::make($request->all(), [
            'tanggal' => 'nullable',
            'id_divisi' => 'required',
            'aktifasi_id' => 'required',
            'bukti' => 'required|image|mimes:png,jpg|max:1024|min:1',
        ], [
            'bukti.required' => 'Upload foto dulu',
            'bukti.mimes' => 'Format gambar harus png atau jpg',
            'bukti.max' => 'Ukuran gambar maksimal 1MB',
        ]);

        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i:00'); // Ambil waktu sekarang


        //dd($currentTime);
        if ($validator->fails()) {
            return redirect()->route('view-presensi')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Data kurang lengkap');
        }

        $fotoFile = $request->file('bukti');
        if (!$fotoFile) {
            return redirect()->route('view-presensi')->with('error', 'Wajib upload bukti');
        }

        $namaFileUnik = Str::uuid() . '' . time() . '' . $fotoFile->getClientOriginalName();
        $fotoPath = $fotoFile->storeAs('public/buktiPresensi', $namaFileUnik);

        $deadLine = Aktifasi::where('id_aktifasi', $request->aktifasi_id)->first();
        // dd($deadLine->tenggat);
        $tenggatDate = Carbon::parse($deadLine->tenggat)->format('Y-m-d'); // Convert tenggat to Y-m-d format
        if ($currentDate > $tenggatDate) {
            return redirect()->route('view-presensi')->with('error', 'Presensi ditutup');
        }

        $cek = Presensi::where([
            'id_anggota' => $anggota->id_anggota,
            'id_divisi'=> $request->id_divisi,
            'tanggal' => $currentDate,
            'aktifasi_id'=>$request->aktifasi_id
        ])->first();

        if ($cek) {
            return redirect()->route('view-presensi')->with('error', 'Anda sudah presensi');
        } else {
            if ($currentTime > $deadLine->tenggat ) {
                return redirect()->route('view-presensi')->with('error', 'Presensi ditutup');
            } else {
                Presensi::create([
                    'id_anggota' => $anggota->id_anggota,
                    'bukti'=>$namaFileUnik,
                    'tanggal' => $currentDate,
                    'id_divisi'=>$request->id_divisi,
                    'aktifasi_id'=>$request->aktifasi_id
                    // 'bukti' => $namaFileUnik,
                ]);
                return redirect()->route('view-presensi')->with('toast_success', 'Berhasil presensi');
            }
        }
    }


    public static function takePendaftar(){
        $user = Auth::user();
        $anggota = Anggota::find($user->id);
        // $pendaftar = Anggota::where('nim', $anggota->nim)->first();
        // dd($anggota);
        return $anggota;
    }
    // public static function takeJadwal1(){
    //     $user = Auth::user();
    //     $jadwalDivisi1 = collect(); // Inisialisasi sebagai koleksi kosong
    //     $pendaftar = Anggota::where('nim', $user->nim)->first();
    //     if ($pendaftar) {
    //         if ($pendaftar->divisi_1) {
    //             $divisi1 = Divisi::where('nama', $pendaftar->divisi_1)->first();
    //             if ($divisi1) {
    //                 $jadwalDivisi1 = Jadwal::where('divisi_id', $divisi1->id)->get();
    //             }
    //         }
    //     }
    //     return $jadwalDivisi1;
    // }
    public static function takeJadwal2(){
        $user = Auth::user();
        $anggota = Anggota::find($user->id_user);  // Cari anggota dengan id = 1

        // Ambil semua id_divisi yang terkait dengan anggota tersebut
        // dd($user);
        $idDivisi = $anggota->divisi->pluck('id_divisi');

        // Ambil semua jadwal yang terkait dengan id_divisi yang didapat
        $jadwalDivisi = Jadwal::whereIn('id_divisi', $idDivisi)->get();

        return $jadwalDivisi;
    }
    public static function takeActiveDivisi(){
        $user = Auth::user();
        $anggota = Anggota::find($user->id_user);
        $idDivisi = $anggota->divisi->pluck('id_divisi');
        $namaDivisi = Divisi::whereIn('id_divisi', $idDivisi)->get();
        return $namaDivisi;
    }
    public static function takeNamaDivisi(){
        $user = Auth::user();
        $anggota = Anggota::find($user->id_user);  // Cari anggota dengan id = 1

        // Ambil semua id_divisi yang terkait dengan anggota tersebut
        $divisi = $anggota->divisi->pluck('nama');
        // dd($divisi);
        return $divisi;
    }
    public static function checkPresensi($index = 0) {
        $user = Auth::user();
        $anggota = Anggota::find($user->id_user); // Cari anggota berdasarkan id user

        // Ambil id_divisi berdasarkan indeks
        $id_divisi = $anggota->divisi->pluck('id_divisi');
        // dd($id_divisi);
        // Pastikan indeks yang diminta tersedia
        if (!isset($id_divisi[$index])) {
            return 'belum presensi'; // Jika id_divisi dengan indeks tersebut tidak ada, dianggap belum presensi
        }

        $currentDate = Carbon::now()->format('Y-m-d');
        $cek = Presensi::where([
            'tanggal' => $currentDate,
            'id_anggota' => $anggota->id_anggota,
            'id_divisi' => $id_divisi[$index],
        ])->first();

        return $cek ? 'sudah presensi' : 'belum presensi';
    }

    // public static function input(Request $request){
    //     $presensi = Presensi::store($request);
    //         return redirect()->route('view-presensi');
    // }

    public static function viewActivatePresensi() {
        $dtJadwal = Jadwal::with('divisi')->get();

        // Ambil semua jadwal_id dari $dtJadwal
        $jadwalIds = $dtJadwal->pluck('id_jadwal')->toArray();

        // Ambil data Aktifasi untuk jadwal yang ada
        $dtAktifasi = Aktifasi::whereIn('jadwal_id', $jadwalIds)->get()->groupBy('jadwal_id');

        Divisi::hapusDivisiNoneDiDataJadwal($dtJadwal);
        // dd($dtJadwal);
        return view('content.presensi.aktivasi', compact('dtJadwal', 'dtAktifasi'));
    }


    public static function updateStatus(Request $request){
        $request->validate([
            'tenggat' => 'required|date_format:H:i',  // Validasi format waktu
        ]);

        $jadwal = Jadwal::findOrFail($request->id);
        $jadwal->aktifasi = ($request->status === 'active');
        $jadwal->tenggat = $request->tenggat;
        $jadwal->save();

        return response()->json([
            'message' => 'Status dan tenggat berhasil diperbarui!',
            'status' => $jadwal->aktifasi ? 'active' : 'inactive'
        ]);
    }

    public static function takeStatus(Request $request){
        $jadwal = Jadwal::findOrFail($request->id);

        // Gunakan accessor di model untuk status
        return response()->json(['status' => $jadwal->aktifasi ? 'active' : 'inactive']);
    }


    public static function aktifasi(Request $request, $id){
        
        $request->validate([
            'tenggat'=>'required|date_format:H:i',
            // 'status'=>'required',
            'pertemuan'=>'required|max:2',
        ],
        [
            'tenggat.date_format' => 'Format waktu salah',
            'pertemuan.max' => 'Maksimal 2 karakter',
        ]);
        $currentDate = Carbon::now()->format('Y-m-d');
        $data = Aktifasi::where('pertemuan', $request->pertemuan)->where('jadwal_id', $id)->first();
        if($data){
            return redirect()->route('aktif-presensi')->with('error', 'data sudah ada');
        }
        Aktifasi::create([
            'tenggat'=>$request->tenggat,
            'status'=>1,
            'pertemuan'=>$request->pertemuan,
            'tanggal'=>$currentDate,
            'jadwal_id'=>$id
        ]);
        return redirect()->route('aktif-presensi')->with('toast_success', 'berhasil aktifasi');
    }

    public static function Scan($request){//ubah ini tamnbai
        // dd($request);
        $userLogin = Auth::user();

        $anggota = Anggota::where('nim', $request)->first();
        // dd($anggota);
        if(!$anggota){
            return redirect()->route('scan-qr')->with('error', 'anda bukan anggota');
        }
        if ($userLogin->id_anggota != $anggota->id_anggota) {
            # code...
            return redirect()->route('scan-qr')->with('error', 'presensi harus menggunakan akun pribadi');
        }
        $dtAktifasi = Aktifasi::takeAktifasi();
        // dd($dtAktifasi[0][0]->id_divisi);
        return view('content.presensi.scanResult', compact('anggota','dtAktifasi'));
    }
    public static function updateValidasi($id){
        $presensi = Presensi::findOrFail($id);
        $presensi->status = 'valid';
        $presensi->save();
        return redirect()->route('data-presensi')->with('success', 'presensi valid!!');
    }
    public static function updateInvalid($id){
        $presensi = Presensi::findOrFail($id);
        $presensi->status = 'invalid';
        $presensi->save();
        return redirect()->route('data-presensi')->with('success', 'presensi invalid!!');
    }
    public static function valid_presensi(){
        $data = Presensi::with(['divisi', 'anggota'])->get();
        foreach ($data as $item) {
            $item['nama_divisi'] = $item->divisi ? $item->divisi->nama : 'Tidak diketahui';
            $item['nama_anggota'] = $item->anggota ? $item->anggota->nama : 'Tidak diketahui';
            $item['pertemuan'] = $item->aktifasirelation ? $item->aktifasirelation->pertemuan : 'Tidak diketahui';
            unset($item['id_divisi'], $item['aktifasi_id'], $item['id_anggota']);
        }
        return view('content.presensi.valid', compact('data'));
    }
    public static function invalid_presensi(){
        $data = Presensi::with(['divisi', 'anggota'])->get();
        foreach ($data as $item) {
            $item['nama_divisi'] = $item->divisi ? $item->divisi->nama : 'Tidak diketahui';
            $item['nama_anggota'] = $item->anggota ? $item->anggota->nama : 'Tidak diketahui';
            $item['pertemuan'] = $item->aktifasirelation ? $item->aktifasirelation->pertemuan : 'Tidak diketahui';
            unset($item['id_divisi'], $item['aktifasi_id'], $item['id_anggota']);
        }
        return view('content.presensi.invalid', compact('data'));
    }
}
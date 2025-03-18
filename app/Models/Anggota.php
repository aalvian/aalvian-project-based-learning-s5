<?php

namespace App\Models;

use App\Mail\ApprovePendaftaran;
use App\Mail\DeclinePendaftaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';
    protected $primaryKey = 'id_anggota';
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'semester',
        'no_telp',
        'cv',
        'jenis_kelamin',
        'status',
        'id_prodi'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function divisi()
    {
        return $this->belongsToMany(Divisi::class, 'divisi_has_anggotas', 'id_anggota', 'id_divisi');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota', 'id_anggota');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_anggota', 'id_anggota');
    }

    public function jabatan()
    {
        return $this->belongsToMany(Jabatan::class, 'jabatan_has_anggotas', 'id_anggota', 'id_jabatan');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public static function getFormPendaftaran()
    {
        $prodi = Prodi::all();
        $divisi = Divisi::all();
        return view('content.pendaftaran.formulir', compact('prodi', 'divisi'));
    }

    public static function postStorePendaftaran(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'nim' => 'required',
            'prodi' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'cv' => 'required|mimes:pdf,doc,docx|max:10240',
            'semester' => 'required',
            'divisi_1' => 'required',
            'divisi_2' => 'nullable|different:divisi_1'
        ], [
            'regex' => 'Nama hanya boleh berisi huruf dan spasi',
            'cv.mimes' => 'CV harus dalam format pdf, doc, atau docx',
        ]);

        try {
            DB::beginTransaction();
            // Cek apakah NIM atau email sudah terdaftar
            $cekPendaftar = Anggota::where('email', $request->email)->first();
            $cekUser = User::where('email', $request->email)->first();

            if ($cekPendaftar || $cekUser) {
                return redirect()->route('home')->with('error', 'NIM atau email sudah terdaftar');
            }

            // Proses file CV jika ada yang diunggah
            $cvFileName = null;
            if ($request->hasFile('cv')) {
                $cvFile = $request->file('cv');
                $cvFileName = time() . '.' . $cvFile->getClientOriginalExtension();
                $cvFile->storeAs('public/cv', $cvFileName);
            }

            // Simpan data ke tabel Anggota
            $anggota = Anggota::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'id_prodi' => $request->prodi,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'cv' => $cvFileName,
                'semester' => $request->semester,
                'status' => 'menunggu' // Status awal adalah 'menunggu'
            ]);

            DB::table('divisi_has_anggotas')->insert([
                'id_anggota' => $anggota->id_anggota,
                'id_divisi' => $request->divisi_1
            ]);

            // Masukkan ke tabel divisi_has_anggotas untuk divisi kedua (jika ada)
            if ($request->divisi_2) {
                DB::table('divisi_has_anggotas')->insert([
                    'id_anggota' => $anggota->id_anggota,
                    'id_divisi' => $request->divisi_2
                ]);
            }

            DB::commit();
            return redirect()->route('landing-page')
                ->with('success', 'Pendaftaran berhasil, pantengin notifikasi emailnya ya!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file CV jika ada error
            if (isset($cvFileName)) {
                Storage::delete('public/cv/' . $cvFileName);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silahkan coba lagi.')
                ->withInput();
        }
    }

    public static function getIndexPendaftaran()
    {
        $dtPendaftaran = Anggota::all();
        return view('content.pendaftaran.index', compact('dtPendaftaran'));
    }

    public static function getIndexPendaftaranDiterima()
    {
        $dtPendaftaran = Anggota::where('status', 'diterima')->get();
        return view('content.pendaftaran.index', compact('dtPendaftaran'));
    }

    public static function getIndexPendaftaranDitolak()
    {
        $dtPendaftaran = Anggota::where('status', 'ditolak')->get();
        return view('content.pendaftaran.index', compact('dtPendaftaran'));
    }

    public static function getDetailDataPendaftaran($id)
    {
        $dtAnggota = Anggota::with(['divisi', 'prodi'])->findOrFail($id);
        if ($dtAnggota->cv) {
            $dtAnggota->cv_base64 = base64_encode($dtAnggota->cv);
        }
        return view('content.pendaftaran.detail', compact('dtAnggota'));
    }

    public static function postDeclinePendaftar($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);

            $anggota->status = 'ditolak';
            $anggota->save();

            Mail::to($anggota->email)->send(new DeclinePendaftaran($anggota));

            return redirect()->route('admin-pendaftaran')->with('success', 'Pendaftaran berhasil ditolak. Email pemberitahuan telah dikirim.');
        } catch (\Exception $e) {
            return redirect()->route('admin-pendaftaran')->with('error', 'Terjadi kesalahan saat menolak pendaftaran.');
        }
    }

    public static function postApprovePendaftar($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Update status menjadi diterima
        $anggota->status = 'diterima';
        $anggota->save();

        // Buat user baru untuk anggota yang diterima
        $user = new User();
        $user->id_anggota = $anggota->id_anggota;
        $user->email = $anggota->email;
        $user->token = Str::random(60);  // Generate token aktivasi
        $user->save();

        // Kirim email aktivasi
        Mail::to($anggota->email)->send(new ApprovePendaftaran($anggota, $user->token));

        return redirect()->route('admin-pendaftaran')->with('success', 'Pendaftaran berhasil diterima. Email aktivasi telah dikirim.');
    }

    public static function getSetPassword($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token aktivasi tidak valid.');
        }
        return view('auth.setpass', compact('token', 'email'));
    }

    public static function postSetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token tidak valid atau sudah digunakan.');
        }

        $user->password = Hash::make($request->password);
        $user->token = null; // Hapus token setelah digunakan
        $user->assignRole('anggota');
        $user->save();

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diatur. Silakan login.');
    }

    //Buat Akun Pengurus

    public static function ViewJabatan()
    {
        $dtPengurus = Anggota::where('status','diterima')->with(['jabatan', 'divisi'])->get();
       // dd($dtPengurus);
        return $dtPengurus;
    }

    public static function TambahJabatan($id_anggota)
    {
        $dtAnggota = Anggota::with(['jabatan', 'divisi'])->findOrFail($id_anggota);
        $jabatans = Jabatan::all();
        $divisi = Divisi::all();
        // dd($dtAnggota->id_anggota);
        return [
            'dtAnggota' => $dtAnggota,
            'jabatans' => $jabatans,
            'divisi' => $divisi,
        ];
    }

    public static function InsertJabatan(Request $request, $id_anggota)
    {
        $request->validate([
            'jabatan' => 'required|exists:jabatans,id_jabatan',
        ]);

        $anggota = Anggota::with(['jabatan', 'user'])->findOrFail($id_anggota);

        if ($anggota->jabatan->contains('id_jabatan', $request->jabatan)) {
            return redirect()->back()->withErrors(['jabatan' => 'Jabatan ini sudah diberikan kepada anggota.']);
        }

        $anggota->jabatan()->attach($request->jabatan);

        // Ambil user dari anggota
        $user = $anggota->user;


        $pendaftar = User::find($id_anggota);
        // dd($pendaftar);
        $pendaftar->assignRole('pengurus');

        $pendaftar = Anggota::find($id_anggota);
        $pendaftar->update([
            'jabatan' => "pengurus",
        ]);
        // $user = auth()->user();
        // $logName = $user->name;
        // activity()->withProperties($pendaftar)->inLog($logName)->log('membuat akun pengurus pada user '.$pendaftar->nama);
        return true;
    }

    public static function RemoveJabatan(Request $request, $id_anggota)
    {
        $request->validate([
            'jabatan' => 'required|exists:jabatans,id_jabatan',
        ]);

        $anggota = Anggota::with(['jabatan', 'user'])->findOrFail($id_anggota);

        // Hapus jabatan yang sudah ada di tabel pivot jika ada
        if ($anggota->jabatan->contains('id', $request->jabatan)) {
            $anggota->jabatan()->detach($request->jabatan);  // Menghapus jabatan yang sudah ada
        }

        // Tambahkan jabatan ke tabel pivot
        $anggota->jabatan()->detach ($request->jabatan);

        // Ambil user dari anggota
        $user = $anggota->user;

        $pengurus = User::findOrFail($id_anggota);
        $pengurus->removeRole('pengurus');

        $pendaftar = Anggota::find($id_anggota);
        $pendaftar->update([
            'jabatan' => NULL,
        ]);

        // Optional: Menambahkan log aktivitas (jika diperlukan)
        // $logName = auth()->user()->name;
        // activity()->withProperties($anggota)->inLog($logName)->log('Menambahkan jabatan pengurus pada anggota '.$anggota->nama);

        return redirect()->route('jabatan')->with('toast_success', 'Jabatan berhasil dihapus dan role diturunkan menjadi anggota.');
    }


}

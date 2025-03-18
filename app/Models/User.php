<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = "id_user";
    protected $fillable = [
        'id_anggota',
        'gambar',
        'email',
        'password',
        'current_role_id',
        'token',
    ];
    public function profile()
    {
        return $this->hasOne(Anggota::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    public function currentRole()
    {
        return $this->belongsTo(Role::class, 'current_role_id');
    }

    public static function validasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required|recaptcha',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Mohon konfirmasi bahwa anda bukan robot.');
        }
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            //setelah login update status pada aktifasi menjadi 0 jika sudah melewati tenggat
            $currentTime = Carbon::now()->format('H:i:s'); // Ambil waktu sekarang
            $currentDate = Carbon::now()->format('Y-m-d');//Ambil tanggal sekarang
            $aktifasi = Aktifasi::all();
            // dd($aktifasi);
            $length = count($aktifasi);
            for ($i = 0; $i<$length; $i++){

                $tanggalAktifasi = $aktifasi[$i]->tanggal;
                $tenggatAktifasi = $aktifasi[$i]->tenggat;
                if($currentDate>$tanggalAktifasi || $currentTime>$tenggatAktifasi){
                    $aktifasi[$i]->update([
                        'status'=>0,
                    ]);
                }
            }
            return redirect()->route('dashboard')->with('success', 'Kamu Berhasil Login');
        } else {
            return redirect()->route('login')->with('error', 'Email atau Password Salah');
        }
    }

    public static function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
        ], [
            'current_password.required_with' => 'Silakan masukkan kata sandi saat ini.',
            'new_password.min' => 'New password minimal 8 karakter.',
            'new_password.max' => 'New password maksimal 12 karakter.',
            'new_password.required_with' => 'Silakan masukkan kata sandi baru.',
            'password_confirmation.min' => 'Confirm password minimal 8 karakter.',
            'password_confirmation.max' => 'Confirm password maksimal 12 karakter.',
            'password_confirmation.required_with' => 'Masukkan konfirmasi kata sandi baru.',
            'password_confirmation.same' => 'Kata sandi tidak sesuai dengan kata sandi baru.',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withErrors('Password saat ini tidak sesuai');
            }
        }

        $user->save();
        $user = auth()->user();
        // $logName = $user->name;
        // activity()->inLog($logName)->log('mengupdate informasi profile');
    }

    public static function gambar(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'gambar.required' => 'Upload foto dulu',
        ]);

        if (Auth::user()->gambar) {
            Storage::delete('public/foto/' . Auth::user()->gambar);
        }

        $fotoFile = $request->file('gambar');
        $namaFileUnik = Str::uuid() . '' . time() . '' . $fotoFile->getClientOriginalName();
        $fotoPath = $fotoFile->storeAs('public/foto', $namaFileUnik);

        $up = DB::table('users')
            ->where('email', Auth::user()->email)
            ->update(['gambar' => $namaFileUnik]);

        if ($up != null) {
            $user = auth()->user();
            $logName = $user->name;
            // activity()->inLog($logName)->log('mengupdate foto profile');
            return redirect()->route('profile')->withSuccess('Profile Berhasil Diubah.');
        } else {
            return redirect()->route('profile')->withErrors('Profile Gagal Diubah.');
        }
    }


}

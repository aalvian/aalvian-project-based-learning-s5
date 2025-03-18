<?php

namespace Tests\Feature;

use App\Models\Aktifasi;
use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\Jadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PresensiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_view_data_presensi_tanpa_login()
    {
        $response = $this->get('data/presensi');
        $response->assertStatus(403);
    }
    public function test_view_data_presensi()
    {
        
        // $anggota = Anggota::factory()->create(); // Membuat anggota terlebih dahulu
        // DB::beginTransaction();
        // DB::table('divisi_has_anggotas')->insert([
        //     'id_anggota' => $anggota->id_anggota,
        //     'id_divisi' => 2
        // ]);
        // DB::table('divisi_has_anggotas')->insert([
        //     'id_anggota' => $anggota->id_anggota,
        //     'id_divisi' => 3
        // ]);
        // DB::commit();
        // $user = User::factory()->create([
        //     'id_anggota' => $anggota->id_anggota,
        // ]); // Membuat user terlebih dahulu
        // $user->assignRole('pengurus', 'anggota','admin'); // Memberikan role pada user
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        $response = $this->get('/data/presensi');
        $response->assertStatus(200);
        // $anggota->delete();
        // $user->delete();
    }
    public function test_view_aktifasi_tanpa_login()
    {
        $response = $this->get('aktifasi/presensi');
        $response->assertStatus(403);
    }
    public function test_aktifasi($id = 3){
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        $data = [
            'tenggat'=>'18:30',
            'pertemuan'=>'1',
            '_token' => csrf_token(), // Menambahkan CSRF token secara manual
        ];
        $response = $this->post(route('aktivasi', ['id' => $id]), $data);
        
        $response->assertStatus(302);
        $this->assertDatabaseHas('aktifasis', [
            'tenggat' => '18:30',
            'pertemuan' => '1',
            'jadwal_id' => $id,
        ]);
    
        // Menghapus data setelah verifikasi
        // Aktifasi::where('jadwal_id', $id)->where('pertemuan', '1')->delete();
    }
    public function test_aktifasi_double($id=3){
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        $data = [
            'tenggat'=>'18:30',
            'pertemuan'=>'1',
            '_token' => csrf_token(), // Menambahkan CSRF token secara manual
        ];
        $response = $this->post(route('aktivasi', ['id' => $id]), $data);
        $response->assertStatus(302);
        $response->assertSessionHas('error', 'data sudah ada');
    }
    public function test_aktifasi_pertemuan_tidak_valid($id=3){
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        $data = [
            'tenggat'=>'18:30',
            'pertemuan'=>'123',
            '_token' => csrf_token(), // Menambahkan CSRF token secara manual
        ];
        $response = $this->post(route('aktivasi', ['id' => $id]), $data);
        
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['pertemuan' => 'Maksimal 2 karakter']);
    }
    public function test_aktifasi_tenggat_tidak_valid($id=3){
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        $data = [
            'tenggat'=>'tenggat',
            'pertemuan'=>'4',
            '_token' => csrf_token(), // Menambahkan CSRF token secara manual
        ];
        $response = $this->post(route('aktivasi', ['id' => $id]), $data);
        
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['tenggat' => 'Format waktu salah']);
    }
    
    public function test_presensi_berhasil(){
        $currentDate = Carbon::now()->format('Y-m-d');
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        // $this->assertAuthenticated();
        $data = [
            'bukti'=>UploadedFile::fake()->image('buktivalid.jpg')->size(100),
            'tanggal'=>$currentDate,
            'id_divisi'=>3,
            'aktifasi_id'=>14,
            '_token' => csrf_token(), // Menambahkan CSRF token secara manual
        ];
        
        $response = $this->post(route('store-presensi'), $data);
        // $response->dump();
        $response->assertStatus(302);
    }

    public function test_presensi_terlambat(){
        $currentDate = Carbon::now()->format('Y-m-d');
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);
        // $this->assertAuthenticated();
        $data = [
            'bukti'=>UploadedFile::fake()->image('buktiterlambat.jpg')->size(100),
            'tanggal'=>$currentDate,
            'id_divisi'=>3,
            'aktifasi_id'=>15,
            '_token' => csrf_token(), // Menambahkan CSRF token secara manual
        ];
        
        $response = $this->post(route('store-presensi'), $data);
        // $response->dump();
        $response->assertSessionHas('error', 'Presensi ditutup');
        $response->assertStatus(302);
    }




    public function test_validasi_bukti_ukuran_maksimal()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);

        // Buat file gambar palsu dengan ukuran 2MB
        $data = [
            'bukti' => UploadedFile::fake()->image('buktimaksimal.jpg')->size(2048),
            'tanggal' => $currentDate,
            'id_divisi' => 3,
            'aktifasi_id' => 14,
            '_token' => csrf_token(),
        ];

        $response = $this->post(route('store-presensi'), $data);

        // Debug error session jika ada masalah
        // $response->dumpSession();

        // Periksa apakah validasi ukuran file gagal dan pesan error muncul
        $response->assertSessionHasErrors([
            'bukti' => 'Ukuran gambar maksimal 1MB',
        ]);

        // Pastikan statusnya adalah 302 karena redirect
        $response->assertStatus(302);
    }



    public function test_validasi_bukti_format_gambar()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $user = User::where('email', 'testing@gmail.com')->first();
        $response = $this->actingAs($user)->post(route('postlogin'), [
                
            'email' => $user->email,
            'password' => 'password', // Sesuaikan jika password default factory
        ]);

        // Buat file gambar palsu dengan format yang tidak valid
        $data = [
            'bukti' => UploadedFile::fake()->image('buktiformatsalah')->size(1000)->extension('php'),
            'tanggal' => $currentDate,
            'id_divisi' => 3,
            'aktifasi_id' => 14,
            '_token' => csrf_token(),
        ];

        $response = $this->post(route('store-presensi'), $data);
        $response->assertSessionHasErrors([
            'bukti' => 'Format gambar harus png atau jpg',
        ]);
        // Pastikan statusnya adalah 302 karena redirect
        $response->assertStatus(302);
    }
}

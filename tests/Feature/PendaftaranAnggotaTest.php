<?php

namespace Tests\Feature;

use App\Mail\ApprovePendaftaran;
use App\Mail\DeclinePendaftaran;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PendaftaranAnggotaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
    public function test_user_sedang_berada_di_halaman_form_pendaftaran(): void
    {
        $response = $this->get(route('view-pendaftaran'));

        $response->assertStatus(200);
    }

    public function test_user_sedang_mengirim_data_pendaftaran(): void
    {
        $data = [
            'nama' => 'Izza Fakhrul',
            'nim' => '362258302117',
            'prodi' => 1,
            'email' => 'izzafakhrul@gmail.com',
            'no_telp' => '08123456789',
            'cv' => UploadedFile::fake()->create('cv.pdf', 1024), // digunakan untuk membuat fake file
            'semester' => 3,
            'divisi_1' => 1,
            'divisi_2' => 2,
        ];

        $response = $this->post(route('store-pendaftaran'), $data);
        $response->assertRedirect(route('landing-page'));

        // cek apakah data sudah masuk
        $this->assertDatabaseHas('anggotas', [
            'email' => 'izzafakhrul@gmail.com',
            'nim' => '362258302117',
            'status' => 'menunggu',
        ]);
    }

    public function test_pengurus_menerima_anggota_dan_mengirim_email_aktifasi()
    {
        Mail::fake();
        $anggota = Anggota::find(3);
        
        if (!$anggota) {
            $this->fail('anggota tidak ada');
        }
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->post(route('pendaftaran-terima', ['id' => $anggota->id_anggota]));

        // Cek apakah status anggota diperbarui menjadi 'diterima'
        $anggota->refresh();
        $this->assertEquals('diterima', $anggota->status);

        // Cek apakah pengguna baru dibuat
        $user_new = User::where('id_anggota', $anggota->id_anggota)->first();
        $this->assertNotNull($user_new);
        $this->assertEquals($anggota->email, $user_new->email);
        $this->assertNotEmpty($user_new->token);

        // Cek apakah email aktivasi dikirim
        Mail::assertSent(ApprovePendaftaran::class, function ($mail) use ($user_new, $anggota) {
            return $mail->hasTo($anggota->email) && $mail->token === $user_new->token;
        });

        // Cek redirect dan pesan sukses
        $response->assertRedirect(route('admin-pendaftaran'));
        $response->assertSessionHas('success', 'Pendaftaran berhasil diterima. Email aktivasi telah dikirim.');
    }

    public function test_user_kedua_sedang_berada_di_halaman_form_pendaftaran(): void
    {
        $response = $this->get(route('view-pendaftaran'));

        $response->assertStatus(200);
    }

    public function test_user_kedua_sedang_mengirim_data_pendaftaran(): void
    {
        $data = [
            'nama' => 'Mohamad Joko',
            'nim' => '362258302120',
            'prodi' => 1,
            'email' => 'jokowarsito@gmail.com',
            'no_telp' => '08123456990',
            'cv' => UploadedFile::fake()->create('cv.pdf', 1024), // digunakan untuk membuat fake file
            'semester' => 3,
            'divisi_1' => 1,
            'divisi_2' => 2,
        ];

        $response = $this->post(route('store-pendaftaran'), $data);
        $response->assertRedirect(route('landing-page'));

        // cek apakah data sudah masuk
        $this->assertDatabaseHas('anggotas', [
            'email' => 'jokowarsito@gmail.com',
            'nim' => '362258302120',
            'status' => 'menunggu',
        ]);
    }
    
    public function test_pengurus_menolak_anggota_dan_mengirim_email_penolakan()
    {
        Mail::fake();
        $anggota = Anggota::find(4);
        
        if (!$anggota) {
            $this->fail('anggota tidak ada');
        }
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->post(route('tolak-pendaftaran', ['id' => $anggota->id_anggota]));

        // Cek apakah status anggota diperbarui menjadi 'diterima'
        $anggota->refresh();
        $this->assertEquals('ditolak', $anggota->status);        

        // Cek apakah email pemberitahuan dikirim
        Mail::assertSent(DeclinePendaftaran::class, function ($mail) use ($anggota) {
            return $mail->hasTo($anggota->email);
        });

        // Cek redirect dan pesan sukses
        $response->assertRedirect(route('admin-pendaftaran'));
        $response->assertSessionHas('success', 'Pendaftaran berhasil ditolak. Email pemberitahuan telah dikirim.');
    }

    public function test_user_ketiga_mendapat_pemberitahuan_bahwa_data_yang_dikirim_salah()
    {
        $data = [
            'nama' => '',
            'nim' => '362258302119',
            'prodi' => 1,
            'email' => 'invalid-email',
            'no_telp' => '081234567890',
            'cv' => UploadedFile::fake()->create('cv.pdf', 1024),
            'semester' => 3,
            'divisi_1' => 1,
            'divisi_2' => 2,
        ];
    
        $response = $this->post(route('store-pendaftaran'), $data);
        
        // apakah ada error dibagian tersebut
        $response->assertSessionHasErrors(['nama', 'email']);
        
        $response->assertStatus(302);
    }

    public function test_user_sedang_berada_di_halaman_aktifasi_email()
    {
        $user = User::find(2);

        $response = $this->get(route('anggota-aktivasi', ['token' => $user->token, 'email' => $user->email]));
        $response->assertStatus(200);
    }

    public function test_user_melakukan_aktifasi_email_yang_berupa_update_password()
    {
        $user = User::find(2);

        $data = [
            'token' => $user->token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('set-pass'), $data);
        $response->assertRedirect(route('login'));
    }
}

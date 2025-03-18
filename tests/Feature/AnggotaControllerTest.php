<?php

namespace Tests\Feature;

use App\Mail\ApprovePendaftaran;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AnggotaControllerTest extends TestCase
{
    use RefreshDatabase;

    // public function testApprovePendaftaran()
    // {
    //     // Buat data dummy untuk anggota
    //     $anggota = Anggota::create([
    //         'nama' => 'Test Anggota',
    //         'nim' => '12345678',
    //         'email' => 'test@example.com',
    //         'status' => 'menunggu',
    //         'semester' => 3,
    //         'no_telp' => '081234567890',
    //         'id_prodi' => 1, // Isi nilai id_prodi dengan ID yang valid
    //     ]);        

    //     // Dummy request data
    //     $requestData = [
    //         'divisi_1' => 1, // ID divisi pertama
    //         'divisi_2' => 2, // ID divisi kedua
    //     ];

    //     // Mock Mail untuk menghindari pengiriman email sungguhan
    //     Mail::fake();

    //     // Hit endpoint untuk approve pendaftaran
    //     $response = $this->post(route('approve_pendaftaran', $anggota->id_anggota), $requestData);

    //     // Periksa response HTTP
    //     $response->assertRedirect(route('approve_pendaftaran'));
    //     $response->assertSessionHas('success', 'Pendaftaran berhasil disetujui dan anggota telah ditambahkan ke dalam sistem.');

    //     // Periksa apakah status anggota berubah
    //     $this->assertDatabaseHas('anggotas', [
    //         'id_anggota' => $anggota->id_anggota,
    //         'status' => 'diterima',
    //     ]);

    //     // Periksa apakah relasi divisi sudah ditambahkan
    //     $this->assertDatabaseHas('divisi_has_anggotas', [
    //         'id_anggota' => $anggota->id_anggota,
    //         'id_divisi' => $requestData['divisi_1'],
    //     ]);

    //     $this->assertDatabaseHas('divisi_has_anggotas', [
    //         'id_anggota' => $anggota->id_anggota,
    //         'id_divisi' => $requestData['divisi_2'],
    //     ]);

    //     // Periksa apakah pengguna baru dibuat
    //     $this->assertDatabaseHas('users', [
    //         'email' => $anggota->email,
    //         'name' => $anggota->nama,
    //         'nim' => $anggota->nim,
    //         'semester' => $anggota->semester,
    //         'no_telp' => $anggota->no_telp,
    //         'id_prodi' => $anggota->id_prodi
    //     ]);

    //     // Periksa apakah email terkirim
    //     Mail::assertSent(ApprovePendaftaran::class, function ($mail) use ($anggota) {
    //         return $mail->anggota->id_anggota === $anggota->id_anggota &&
    //                $mail->hasTo($anggota->email);
    //     });
    // }

    // public function testApprovePendaftaranWithAlreadyAcceptedStatus()
    // {
    //     // Buat data dummy untuk anggota dengan status "diterima"
    //     $anggota = Anggota::create([
    //         'nama' => 'Test Anggota',
    //         'nim' => '12345678',
    //         'email' => 'test@example.com',
    //         'status' => 'diterima',
    //         'semester' => 3,
    //         'no_telp' => '081234567890'            
    //     ]);

    //     // Dummy request data
    //     $requestData = [
    //         'divisi_1' => 1, // ID divisi pertama
    //         'divisi_2' => 2, // ID divisi kedua
    //     ];

    //     // Hit endpoint untuk approve pendaftaran
    //     $response = $this->post(route('approve_pendaftaran', $anggota->id_anggota), $requestData);

    //     // Periksa response HTTP
    //     $response->assertRedirect(route('index_pendaftaran'));
    //     $response->assertSessionHas('error', 'Anggota ini sudah diterima sebelumnya.');

    //     // Periksa apakah tidak ada perubahan pada tabel
    //     $this->assertDatabaseMissing('divisi_has_anggotas', [
    //         'id_anggota' => $anggota->id_anggota,
    //     ]);
    // }
}

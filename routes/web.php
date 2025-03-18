<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BuatAkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SwitchRoleController;
use App\Http\Controllers\TimeLineController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [TimeLineController::class, 'timeline'])->name('landing-page');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// *** DASHBOARD ***//
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// *** SWITCH ROLE ***//
Route::middleware(['auth'])->group(function () {
    Route::get('/switch-role/{role}', SwitchRoleController::class)->name('switch.role');
});

// * MENDAFTAR * //
Route::get('/pendaftaran/form', [AnggotaController::class, 'pendaftaran'])->name('view-pendaftaran');
Route::post('/store-pendaftaran', [AnggotaController::class, 'create_pendaftaran'])->name('store-pendaftaran');


//* PENDAFTARAN * //
Route::group(['middleware' => ['can:manage_pendaftar']], function () {
    Route::get('/pendaftaran', [AnggotaController::class, 'index_pendaftaran'])->name('admin-pendaftaran');
    Route::get('/pendaftaran/diterima', [AnggotaController::class, 'index_pendaftaran_diterima'])->name('admin-pendaftaran-terima');
    Route::get('/pendaftaran/ditolak', [AnggotaController::class, 'index_pendaftaran_ditolak'])->name('admin-pendaftaran-tolak');
    Route::get('/pendaftaran/detail/{id}', [AnggotaController::class, 'detail_pendaftaran'])->name('admin-pendaftaran-detail');
    Route::post('/pendaftaran/terima/{id}', [AnggotaController::class, 'approve_pendaftaran'])->name('pendaftaran-terima');
    Route::post('/pendaftaran/tolak/{id}', [AnggotaController::class, 'decline_pendaftaran'])->name('tolak-pendaftaran');
});


// * PASSWORD * //
Route::get('/anggota/aktivasi/{token}/{email}', [AnggotaController::class, 'aktivasi'])->name('anggota-aktivasi');
Route::post('/set-password', [AnggotaController::class, 'setpass'])->name('set-pass');



// * TIMELINE * //
Route::group(['middleware' => ['can:manage_timeline']], function () {
    Route::get('/timeline', [TimeLineController::class, 'index'])->name('view-timeLine');
    Route::post('/timeline/update/{id}', [TimeLineController::class, 'update'])->name('timeline-update');
});



// Route::get('/divisi', action: [DivisiController::class, 'index'])->name('divisi')->middleware('role_or_permission:pengurus|anggota|manage_divisi');
Route::get('/divisi/{id}', [DivisiController::class, 'viewAnggota'])->name('view-anggota');
Route::get('/divisi', [DivisiController::class, 'ViewDivisi'])->name('divisi')->middleware('role_or_permission:pengurus|anggota|manage_divisi');

// *** DIVISI *** //
Route::group(['middleware' => ['can:manage_divisi']], function () {
    Route::get('/tambahdivisi', [DivisiController::class, 'CreateDivisi'])->name('tambahdivisi');
    Route::post('/storeDivisi', [DivisiController::class, 'storeDivisi'])->name('storeDivisi');
    Route::get('/editdivisi/{id_divisi}', [DivisiController::class, 'Editdivisi'])->name('editdivisi');
    Route::post('/ubahedit/{id_divisi}', [DivisiController::class, 'ubahedit'])->name('ubahedit');
    Route::delete('/hapusdivisi/{id_divisi}', [DivisiController::class, 'hapusdivisi'])->name('hapusdivisi');
});


// * JADWAL * //
Route::group(['middleware' => ['can:manage_jadwal']], function () {
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('create-jadwal');
    Route::post('/jadwal/simpan', [JadwalController::class, 'store'])->name('simpan-jadwal');
    Route::get('/jadwal/edit/{id}', [JadwalController::class, 'edit'])->name('edit-jadwal');
    Route::post('/jadwal/update/{id}', [JadwalController::class, 'update'])->name('update-jadwal');
    Route::delete('/jadwal/delete/{id}', [JadwalController::class, 'destroy'])->name('delete-jadwal');
});


// *** ALAT *** //
Route::group(['middleware' => ['can:manage_alat']], function () {
    Route::get('/Alat', [AlatController::class, 'VeiwAlat'])->name('Alat');
    Route::get('/Fromalat', [AlatController::class, 'FormCalat'])->name('FormAlat');
    Route::post('/Store', [AlatController::class, 'StoreAlat'])->name('StoreAlat');
    Route::get('/editalat/{id_alat}', [AlatController::class, 'FindId'])->name('FindId');
    Route::post('/ediubah/{id_alat}', [AlatController::class, 'updatealat'])->name('updatealat');
    Route::delete('/hapusalat/{id_alat}', [AlatController::class, 'hapusalat'])->name('hapusalat');
});


// *** PEMINJAMAN *** //
Route::group(['middleware' => ['can:transaksi']], function () {
    Route::get('/pinjam', [PeminjamanController::class, 'index'])->name('peminjaman');
    Route::get('/pinjam/create', [PeminjamanController::class, 'create'])->name('create-pinjam');
    Route::post('/pinjam/simpan', [PeminjamanController::class, 'store'])->name('simpan-pinjam');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian');
    Route::get('/pengembalian/create/{id}', [PengembalianController::class, 'create'])->name('create-kembali');
    Route::post('/pengebalian/simpan', [PengembalianController::class, 'store'])->name('simpan-kembali');
    Route::delete('/pengembalian/delete/{id}', [PengembalianController::class, 'destroy'])->name('delete-pengembalian');
});


// * BUAT AKUN * //
Route::group(['middleware' => ['can:manage_pengurus']], function () {
    Route::get('/jabatan', [BuatAkunController::class, 'ViewJabatan'])->name('jabatan');
    Route::get('/editjabatan/{id_anggota}', [BuatAkunController::class, 'MenampilkanData'])->name('JabatanT');
    Route::post('/TambahJabatan/{id_anggota}', [BuatAkunController::class, 'JabatanTambah'])->name('JabatanTambah');
    Route::get('/deletejabatan/{id_anggota}', [BuatAkunController::class, 'delete'])->name('Delete');
    Route::post('/HapusJabatan/{id_anggota}', [BuatAkunController::class, 'JabatanHapus'])->name('JabatanHapus');
});


// *** PRESENSI *** //
Route::group(['middleware' => ['can:presensi']], function () {
    Route::get('/presensi', [PresensiController::class, 'index'])->name('view-presensi');
    Route::post('presensi/store', [PresensiController::class, 'inputPresensi'])->name('store-presensi');
    Route::post('/scan-result', [PresensiController::class, 'Scanner'])->name('scan-result');
    Route::get('/scan-qr', function () {
        return view('content.presensi.scan'); // Halaman untuk memindai QR atau Barcode
    })->name('scan-qr');
});
Route::group(['middleware' => ['can:manage_presensi']], function () {
    Route::get('/data/presensi', [PresensiController::class, 'view'])->name('data-presensi');
    Route::get('aktifasi/presensi', [PresensiController::class, 'activatePresensiView'])->name('aktif-presensi');
    Route::post('/updateStatus', [PresensiController::class, 'toggleStatus'])->name('update-status');
    Route::post('/activate/{id}', [PresensiController::class, 'activate'])->name('aktivasi');
    Route::get('/cetak/presensi', [PresensiController::class, 'cetak_presensi'])->name('cetak-presensi');
    Route::get('/cetak/presensi/filter{status}', [PresensiController::class, 'cetak_presensi_filter'])->name('cetak-presensi-filter');
    Route::post('/validasi/{id}', [PresensiController::class, 'validasi'])->name('validasi-presensi');
    Route::post('/invalid/presensi/{id}', [PresensiController::class, 'invalidasi'])->name('invalidasi-presensi');
    Route::get('/presensi/validation', [PresensiController::class, 'valid'])->name('data-presensi-valid');
    Route::get('/presensi/invalid', [PresensiController::class, 'invalid'])->name('data-presensi-invalid');
    Route::get('/presensi/detail/{id}', [PresensiController::class, 'detail'])->name('detail-presensi');
});


// *** PROFILE *** //
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('update-profile');
Route::post('/profile/update', [ProfileController::class, 'updateGambar'])->name('gambar-profile');
Route::post('/profile/delete', [ProfileController::class, 'deleteGambar'])->name('delete-profile');

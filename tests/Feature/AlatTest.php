<?php

namespace Tests\Feature;

use App\Models\Alat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlatTest extends TestCase
{

//     public function test_view_alat_tanpa_login(){
//     $response = $this->get('/alat');
    
//     $response->assertStatus(403);
// }
    // public function test_view_alat_setelah_login(){
    //     $user = User::factory()->create([
    //         'nim'=>'362258302063',
    //         'prodi'=>'TRPL'
    //     ]);
    //     $user->assignRole('admin');
    //     $response = $this->actingAs($user)->get('alat');
    //     $response->assertStatus(200);
    // }

    /**
     * A basic feature test example.
     */
//     public function test_create_alat(){
//         $data = [//buat data yang akan di masukkan
//             'nama_alat'=>'meja',
//             'stok'=>4,
//         ];
//         $alat = Alat::create($data);//masukkan data
//         $cek = $this->assertDatabaseHas('alats', [//periksa apakah datanya sudah ada
//             'nama_alat'=>'meja',
//             'stok'=>4,
//         ]);
//         if ($cek) {
//             # code...
//             $alat->delete();

//         }
        
//         // $this->assertModelExists($alat);
//     }

//     public function test_edit_alat(){
//     // Data awal untuk membuat alat
//     $data = [
//         'nama_alat' => 'meja',
//         'stok' => 4,
//     ];

//     // Membuat data alat baru
//     $alat = Alat::create($data);

//     // ID alat yang akan di-update
//     $idAlat = $alat->id_alat; // Menyimpan id alat yang baru dibuat

//     // Data baru untuk meng-update alat
//     $updateData = [
//         'nama_alat' => 'kursi',
//         'stok' => 10,
//     ];

//     // Menemukan data alat berdasarkan id dan melakukan update
//     $alatToUpdate = Alat::find($idAlat);
//     $alatToUpdate->update($updateData);

//     // Memastikan data di database sudah ter-update dengan benar
//     $cek = $this->assertDatabaseHas('alats', [
//         'id_alat' => $idAlat,
//         'nama_alat' => 'kursi',
//         'stok' => 10,
//     ]);

//     // Memastikan data lama sudah tidak ada di database
//     $this->assertDatabaseMissing('alats', [
//         'id_alat' => $idAlat,
//         'nama_alat' => 'meja',
//         'stok' => 4,
//     ]);
//     if($cek){
//         $alatToUpdate->delete();
//     }
// }

// public function test_delete_alat(){
//     $alat = [
//         'nama_alat'=>'raket',
//         'stok'=>4
//     ];
//     $alat = Alat::create($alat);
//     $alat->delete();
//     $this->assertDatabaseMissing('alats',[
//         'nama_alat'=>'raket',
//         'stok'=>3
//     ]);
// }
}

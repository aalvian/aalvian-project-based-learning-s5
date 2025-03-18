<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Divisi;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{

    public function index()
    {
        $viewJadwal = Jadwal::viewJadwal();
        return $viewJadwal;
    }


    public function create() // relasi untuk menampilkan divisi
    {
        $divisis = Divisi::all();
        Divisi::hapusDivisiNoneDiDataJadwal($divisis);
        return view ('admin.jadwal.create', compact('divisis'));
    }


    public function store(Request $request)
    {
        $createJadwal = Jadwal::createJadwal($request);
        return $createJadwal;
    }



    public function edit($id)
    {
        $viewEdit = Jadwal::viewEditJadwal($id);
        return $viewEdit;
    }


    public function update(Request $request, string $id)
    {
        $updateJadwal = Jadwal::updateJadwal($request, $id);
        return $updateJadwal;
    }


    public function destroy(string $id)
    {
        $hapusJadwal = Jadwal::dropJadwal($id);
        return $hapusJadwal;
    }
}

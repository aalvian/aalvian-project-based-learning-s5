<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function VeiwAlat()
    {
        $dtAlat = Alat::LihatAlat();
        return view('admin.alat.index', compact('dtAlat'));
    }

    public function FormCalat()
    {
        return view('admin.alat.create');
    }

    public function StoreAlat(Request $request)
    {
        Alat::StoreAlat($request);
        return redirect()->route('Alat')->with('toast_success', 'Data Berhasil Disimpan');
    }

    public function FindId($id_alat)
    {
        $id = decrypt($id_alat);
        $alats = Alat::IdEdit($id);
         return view('admin.alat.edit', compact('alats'));

    }

    public function updatealat(Request $request, $id_alat)
    {
        Alat::updatealat($request, $id_alat);
        return redirect()->route('Alat')->with('toast_success', 'Data Berhasil Diubah');
    }

    public function hapusalat($id_alat)
    {
        Alat::hapusalat($id_alat);
        return redirect()->route('Alat')->with('toast_success', 'Data Berhasil Dihapus');
    }
}

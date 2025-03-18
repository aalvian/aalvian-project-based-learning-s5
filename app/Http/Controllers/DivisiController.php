<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function viewAnggota($id)
    {
        $id = decrypt($id);
        // dd($id);
        $divisi = Divisi::findOrFail($id);
        $anggota = $divisi->anggota;

        foreach ($anggota as $item) {
            $user = User::where('id_anggota', $item->id_anggota)->first();
            if ($user) {
                $item->gambar = $user->gambar;
                // dd($anggota);
            }
        }

        return view('content.divisi.viewAnggota', compact('divisi', 'anggota', 'user'));
    }
    public function ViewDivisi()
    {
        $dtDivisi = Divisi::ViewDivisi();
        // $dtDivisi = Divisi::hapusDivisiNoneDiDataJadwal($dtDivisi);
        return view('admin.divisi.index', compact('dtDivisi'));

    }
    public function CreateDivisi()
    {
        return view('admin.divisi.create');
    }
    public function storeDivisi(Request $request)
    {
        Divisi::Tambah($request);

    return redirect()->route('divisi')->with('toast_success', 'Data Berhasil Disimpan');
    }

    public function Editdivisi($id_divisi)
    {
        // dd('hello ');
        $id = decrypt($id_divisi);
        // dd($id);
        $divisis = Divisi::temukan($id);
        // dd($divisis);
        return view('admin.divisi.edit', compact('divisis'));
    }

    public function ubahedit(Request $request, $id)
    {
        Divisi::edit($request, $id);
        return redirect()->route('divisi')->with('toast_success', 'Divisi berhasil diperbarui.');
    }

    public function hapusdivisi($id_divisi)
    {
        Divisi::hapus($id_divisi);
        return redirect()->route('divisi')->with('toast_success', 'Data Berhasil Dihapus');
    }
}

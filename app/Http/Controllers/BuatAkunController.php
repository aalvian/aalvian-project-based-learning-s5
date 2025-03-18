<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class BuatAkunController extends Controller
{
    public function ViewJabatan()
    {
        $dtPengurus = Anggota::ViewJabatan();
        // dd($dtPengurus);
        return view('admin.buatAkunPengurus.index', compact('dtPengurus'));
    }

    public function MenampilkanData($id_anggota)
    {
        $data = Anggota::TambahJabatan($id_anggota);

        return view('admin.buatAkunPengurus.create', [
            'dtAnggota' => $data['dtAnggota'],
            'jabatans' => $data['jabatans'],
            'divisi' => $data['divisi']
        ]);
    }

    public function JabatanTambah(Request $request, $id_anggota)
    {
        $result = Anggota::InsertJabatan($request, $id_anggota);

        if (!$result) {
            return redirect()->back()->withErrors(['jabatan' => 'Anggota sudah memiliki jabatan ini atau data user tidak ditemukan.']);
        }

        return redirect()->route('jabatan')->with('toast_success', 'Jabatan berhasil ditambahkan.');
    }

    public function delete($id_anggota)
    {
        $data = Anggota::TambahJabatan($id_anggota);

        return view('admin.buatAkunPengurus.detail', [
            'dtAnggota' => $data['dtAnggota'],
            'jabatans' => $data['jabatans'],
            'divisi' => $data['divisi']
        ]);
    }

    public function JabatanHapus(Request $request, $id_anggota)
    {
        $result = Anggota::RemoveJabatan($request, $id_anggota);

        if (!$result) {
            return redirect()->back()->withErrors(['jabatan' => 'Jabatan tidak ditemukan atau sudah dihapus.']);
        }

        return redirect()->route('jabatan')->with('toast_success', 'Jabatan berhasil dihapus.');
    }
}

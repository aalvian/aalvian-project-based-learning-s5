<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengembalianController extends Controller
{
    public function index()
    {
        $dtpengembalian = Pengembalian::latest()->get();
        // dd($dtpengembalian);
        // $length = count($dtpengembalian);
        // for($i = 0; $i<$length; $i++){

        //     $user = User::where('id_user', $dtpengembalian[$i]->petugas_id)->get();
        //     //dd($user[$i]->id_anggota); 
        //    // dd($user);
        //     $anggota = Anggota::where('id_anggota', $user[$i]->id_anggota)->get();
        //     // dd($anggota[$i]->nama);
        // //    dd($anggota);
        //     $dtpengembalian['nama_petugas'] = $anggota[$i]->nama;

        // }
        // dd($dtpengembalian);
        $dataList = Pengembalian::with('peminjaman.anggota')->get();
        return view('content.pengembalian.index', compact('dtpengembalian', 'dataList'));
    }

    public function create($id_peminjaman)
    {

        $dtpeminjaman = Peminjaman::findOrFail($id_peminjaman);
        // Pass the data to the create view
        return view('content.pengembalian.kembali', compact('dtpeminjaman',));
    }

    public function store(Request $request)
    {
        Pengembalian::kembali($request);
        return redirect()->route('pengembalian')->with('toast_success', 'Data berhasil dikembalikan.');
    }




    public function destroy(string $id_pengembalian)
    {
        $alat = Pengembalian::findOrFail($id_pengembalian);
        $alat->delete();
        return back()->with('toast_success', 'Data Berhasil Dihapus');
    }
}

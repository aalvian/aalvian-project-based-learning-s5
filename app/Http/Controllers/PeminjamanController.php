<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// ...


class PeminjamanController extends Controller
{

    public function index()
    {
        $peminjaman = Peminjaman::with('anggota', 'alat')->where('status', 'dipinjam')->get();

        // dd($peminjaman);
        $length = count($peminjaman);
        for($i = 0; $i<$length;  $i++){

            $petugas = User::where('id_user',$peminjaman[$i]->petugas_id )->get();
            // dd($petugas);
            $namaPetugas = Anggota::where('id_anggota', $petugas[0]->id_anggota)->get();
            $peminjaman[$i]['nama_petugas'] = $namaPetugas[0]->nama;
        }
        // dd($peminjaman[3]->nama_petugas);
        // dd($petugas[0]->id_anggota);
        // foreach($peminjaman as  $pinjam){
        //     dd($pinjam);
        // }

        return view('content.peminjaman.index', compact('peminjaman', 'petugas',));
    }


    public function create() // relasi untuk menampilkan nama alat
    {

        $alat = Alat::all();
        $anggota = Anggota::with('prodi')->orderBy('nama', 'asc')->get();
        //  dd($anggota);
        return view('content.peminjaman.create', compact('alat', 'anggota'));
    }


    public function store(Request $request)
    {
            Peminjaman::pinjam($request);

            return redirect()->route('peminjaman')->with('toast_success', 'Peminjaman berhasil dibuat');
    }
}

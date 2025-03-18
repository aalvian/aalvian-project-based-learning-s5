<?php

namespace App\Http\Controllers;

use App\Models\Aktifasi;
use App\Models\Anggota;
use App\Models\Divisi;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|pengurus|anggota');
    }

    public function index()
    {
        $totalPendaftar = Anggota::all()->count();
        $totalDivisi = Divisi::all()->count();
        $pendaftarTerima = Anggota::where('status', 'diterima')->count();
        $pendaftarTolak = Anggota::where('status', 'ditolak')->count();

        $persentaseTerima = ($pendaftarTerima / $totalPendaftar) * 100;
        $persentaseTolak = ($pendaftarTolak / $totalPendaftar) * 100;


        // $user = auth()->user();
        // $logName = $user->name;
        // activity()->inLog($logName)->log('membuka beranda');
        $divisis = Divisi::all();
        $divisiNames = [];
        $aktifasiCounts = [];
    
        foreach ($divisis as $divisi) {
            if ($divisi->nama === "None") {
                continue; // Lewati divisi dengan nama "None"
            }
    
            // Hitung jumlah aktifasi terkait dengan divisi ini
            $aktifasiCount = Aktifasi::whereHas('jadwal', function ($query) use ($divisi) {
                $query->where('id_divisi', $divisi->id_divisi);
            })->count();
    
            $divisiNames[] = $divisi->nama;
            $aktifasiCounts[] = $aktifasiCount;
        }
    
        return view('layouts.dashboard', compact('totalPendaftar', 'totalDivisi', 'pendaftarTerima', 'pendaftarTolak', 'persentaseTerima', 'persentaseTolak', 'divisiNames', 'aktifasiCounts'));

    }

}

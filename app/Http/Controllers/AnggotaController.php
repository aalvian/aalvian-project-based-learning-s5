<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function pendaftaran()
    {
        return Anggota::getFormPendaftaran();
    }

    public function create_pendaftaran(Request $request)
    {
        return Anggota::postStorePendaftaran($request);
    }

    public function index_pendaftaran()
    {
        return Anggota::getIndexPendaftaran();
    }

    public function index_pendaftaran_diterima()
    {
        return Anggota::getIndexPendaftaranDiterima();
    }

    public function index_pendaftaran_ditolak()
    {
        return Anggota::getIndexPendaftaranDitolak();
    }

    public function detail_pendaftaran($id)
    {
        return Anggota::getDetailDataPendaftaran($id);
    }

    public function decline_pendaftaran($id)
    {
        return Anggota::postDeclinePendaftar($id);
    }

    public function approve_pendaftaran($id)
    {
        return Anggota::postApprovePendaftar($id);
    }

    public function aktivasi($token, $email)
    {
        return Anggota::getSetPassword($token, $email);
    }

    public function setpass(Request $request)
    {
        return Anggota::postSetPassword($request);
    }
}

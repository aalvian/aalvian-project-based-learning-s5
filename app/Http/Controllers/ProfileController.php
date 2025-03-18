<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('content.profile.index');
    }


    public function update(Request $request)
    {
        User::update_profile($request);
        return redirect()->route('profile')->withSuccess('Profile Berhasil Diubah.');
    }


    public function updateGambar(Request $request)
    {
        return User::gambar($request);
    }


    public function deleteGambar(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        if ($user->gambar) {
            Storage::delete('public/foto/' . $user->gambar);
        }

        // $user->gambar = null;
        // $user->save();
        // $user = auth()->user();
        // $logName = $user->name;
        // activity()->inLog($logName)->log('menghapus foto profil');
        return redirect()->route('profile')->withSuccess('Profile Berhasil Diubah.');
    }
}


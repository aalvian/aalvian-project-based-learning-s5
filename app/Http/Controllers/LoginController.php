<?php

namespace App\Http\Controllers;

use App\Models\Aktifasi;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $validate = User::validasi($request);
        return $validate;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

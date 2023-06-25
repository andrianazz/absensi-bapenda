<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        if (Auth::attempt($request->only(['nik', 'password']))) {
            //if user unit_kerja_id == 21 go to dashboard
            if (Auth::user()->unit_kerja_id == 21) {
                return redirect('/');
            } else {
                return redirect('/login')->with('failed', 'Anda tidak memiliki akses');
            }
        }

        return redirect('/login')->with('failed', 'Username atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

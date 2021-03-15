<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    function loginPost(Request $request)
    {
        if (Auth::guard('pemilik')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            alert()->basic('Anda Login Sebagai Pemilik', 'Hello');
            return redirect()->intended(route('pemilik.dashboard'));
        } else if (Auth::guard('pegawai')->attempt(['email' => $request->email, 'password' => $request->password])) {
            alert()->basic('Anda Login Sebagai Pegawai', 'Hello');
            return redirect()->intended(route('kasir'));
        } else {
            //Gagal Login
            alert()->error('Password atau Email, Salah !', 'Gagal Login !');
            return redirect()->route('login')->with('alert', 'Password atau Email, Salah !');
        }
    }

    function logout()
    {
        if (Auth::guard('pemilik')->check()) {
            Auth::guard('pemilik')->logout();
        } else if (Auth::guard('pegawai')->check()) {
            Auth::guard('pegawai')->logout();
        }
        return redirect()->route('login')->with('alert', 'Kamu sudah logout');
    }
}

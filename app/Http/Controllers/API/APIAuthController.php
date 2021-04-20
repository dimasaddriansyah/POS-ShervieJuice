<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIAuthController extends Controller
{
    public function loginPost(Request $request, Pemilik $pemilik, Pegawai $pegawai)
    {
        if (Auth::guard('pemilik')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            $pemilik = $pemilik->find(Auth::guard('pemilik')->user()->id);

            return response()->json([
                'message' => 'Login Pemilik Berhasil',
                'data' => $pemilik,
            ], 200);
        } else if (Auth::guard('pegawai')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            $pegawai = $pegawai->find(Auth::guard('pegawai')->user()->id);

            return response()->json([
                'message' => 'Login Pegawai Berhasil',
                'data' => $pegawai,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Password atau Email, Salah !',
                'data' => ''
            ], 401);
        }
    }
}

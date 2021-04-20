<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class APIPegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::get();

        return response()->json(
            ['message' => 'Success', 'data' => $pegawais],
            200
        );
    }

    public function store(Request $request)
    {
        $pegawais = new pegawai();
        $pegawais->nama = ucwords($request->nama);
        $pegawais->email = $request->email;
        $pegawais->password = $request->password;
        $pegawais->alamat = ucwords($request->alamat);
        $pegawais->no_hp = $request->no_hp;
        $pegawais->save();

        return response()->json(
            ['message' => 'Data Was Created', 'data' => $pegawais],
            201
        );
    }
}

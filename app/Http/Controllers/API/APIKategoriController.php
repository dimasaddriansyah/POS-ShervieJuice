<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class APIKategoriController extends Controller
{
    public function index()
    {
        $kategories = Kategori::get();

        return response()->json(['message' => 'Success', 'data' => $kategories]);
    }

    public function store(Request $request)
    {
        $kategoris = new Kategori();
        $kategoris->nama = ucwords($request->nama);
        $kategoris->save();

        return response()->json(
            ['message' => 'Data Was Created', 'data' => $kategoris],
            201
        );
    }
}

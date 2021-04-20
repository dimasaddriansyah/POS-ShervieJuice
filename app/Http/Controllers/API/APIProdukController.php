<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;

class APIProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with(['supplier', 'kategori'])->get();

        // return response()->json(['message' => 'Success', 'data' => $produks]);
        return ProdukResource::collection($produks);
    }
}

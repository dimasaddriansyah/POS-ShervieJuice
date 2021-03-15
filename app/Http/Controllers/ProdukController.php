<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(){
        $produks = Produk::with('kategori')->orderBy('stok')->get();
        $kritis = Produk::where('stok','<',5)->where('stok','>',0)->count();
        $habis = Produk::where('stok','=',0)->count();
        return view('content.pemilik.produk.index', compact('produks', 'habis', 'kritis'));
    }
}

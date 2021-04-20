<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukMasukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori', 'supplier')->orderBy('stok','ASC')->get();
        $suppliers = Supplier::get();
        $kategoris = Kategori::get();
        $habis = Produk::where('stok', '=', 0)->count();
        return view('content.pemilik.produk_masuk.index', compact('produks', 'kategoris', 'suppliers', 'habis'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'supplier' => 'required',
                'kategori' => 'required',
                'nama' => 'required|min:4|regex:/^[\pL\s\-]+$/u',
                'harga' => 'required|min:1|integer',
                'jumlah' => 'required|min:1|integer',
            ],
            [
                'supplier.required' => 'Harus Mengisi Bagian Nama Supllier !',
                'kategori.required' => 'Harus Mengisi Bagian Nama Kategori !',
                'nama.required' => 'Harus Mengisi Bagian Nama produk !',
                'nama.min' => 'Minimal 4 Karakter !',
                'nama.regex' => 'Inputan Nama Tidak Valid !',
                'harga.required' => 'Harus Mengisi Bagian Harga Jual !',
                'harga.min' => 'Tidak Boleh 0 Atau Minus !',
                'jumlah.required' => 'Harus Mengisi Bagian Jumlah produk !',
                'jumlah.min' => 'Tidak Boleh 0 Atau Minus !',
            ]
        );

        $produk = new Produk();

        $produk->nama = ucwords($request->nama);
        $produk->supplier_id = $request->supplier;
        $produk->kategori_id = $request->kategori;
        $produk->harga = $request->harga;
        $produk->stok = $request->jumlah;
        $produk->stok_masuk = $request->jumlah;
        $produk->save();

        alert()->success('Data Berhasil Di Tambah !', 'Success');
        return redirect()->route('produk.index');
    }

    public function tambahStok(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'stok' => 'required|min:1|integer',
            ],
            [
                'stok.required' => 'Harus Mengisi Bagian Harga Stok !',
                'stok.min' => 'Tidak Boleh 0 Atau Minus !',
            ]
        );
        $produk = Produk::find($id);
        $produk->stok = $request->stok + $produk->stok;
        $produk->update();

        alert()->success('Stock Berhasil Di Update !', 'Success');
        return redirect()->route('produk.index');
    }

    public function editHarga(Request $request,$id)
    {
        $this->validate($request, [
            'harga' => 'required|min:1|integer',
        ],
        [
            'harga.required' => 'Harus Mengisi Bagian Harga Jual !',
            'harga.min' => 'Tidak Boleh 0 Atau Minus !',
        ]);

        $produk = Produk::find($id);
        $produk->harga = $request->harga;
        $produk->update();

        alert()->success('Harga Berhasil Di Update !', 'Success');
        return redirect()->route('produk.index');
    }
}

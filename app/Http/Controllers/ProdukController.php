<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaturan;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Throwable;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->orderBy('stok')->get();
        $kritis = Produk::where('stok', '<', 5)->where('stok', '>', 0)->count();
        $habis = Produk::where('stok', '=', 0)->count();
        $pengaturan = Pengaturan::first();
        $suppliers = Supplier::get();
        $kategoris = Kategori::get();


        return view('content.pemilik.produk.index', compact('produks', 'habis', 'kritis', 'suppliers', 'kategoris', 'pengaturan'));
    }

    public function update(Request $request, $id)
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

        $produks = Produk::find($id);
        $produks->nama = ucwords($request->nama);
        $produks->supplier_id = $request->supplier;
        $produks->kategori_id = $request->kategori;
        $produks->harga = $request->harga;
        $produks->stok = $request->jumlah;
        $produks->update();

        alert()->success('Data Produk Berhasil Di Update', 'Update');
        return redirect()->route('produk.index');
    }

    public function destroy($id)
    {
        try {
            Produk::find($id)->delete();
            alert()->success('Data Terhapus', 'Deleted');
            return redirect()->route('produk.index');
        } catch (Throwable $e) {
            alert()->error('Data Tidak Dapat Dihapus Karena Relasi RESCRICT', 'Error');
            return redirect()->route('produk.index');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaturan;
use App\Models\Produk;
use App\Models\Supplier;
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

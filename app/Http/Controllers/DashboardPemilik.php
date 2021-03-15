<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pegawai;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;

class DashboardPemilik extends Controller
{
    public function dashboard()
    {
        $pegawai = Pegawai::count();
        $supplier = Supplier::count();
        $kategori = Kategori::count();
        $produk = Produk::count();
        $kritis = Produk::where('stok','<',5)->where('stok','>',0)->count();
        $habis = Produk::where('stok','=',0)->count();
        $keuangan = Transaksi_Detail::get();
        $pendapatan = Transaksi::sum('jumlah_harga');
        $keuntungan = 0;
        foreach ($keuangan as $k) {
            $untung = $k->jumlah_harga - ($k->jumlah_beli * $k->produk->harga);
            $keuntungan += $untung;
        }

        return view('content.pemilik.dashboard', compact('pegawai', 'supplier', 'kategori', 'produk','kritis','habis', 'pendapatan' ,'keuntungan'));
    }
}

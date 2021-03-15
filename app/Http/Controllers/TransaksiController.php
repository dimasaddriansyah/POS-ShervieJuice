<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Transaksi_Detail;

class TransaksiController extends Controller
{
    public function Transaksi(){
        $transaksi = Transaksi::where('status', 1)->get();

        return view('content.pemilik.transaksi.index', compact('transaksi'));
    }

    public function Keuangan(){
        $keuangan = Transaksi_Detail::orderBy('created_at', 'DESC')->get();
        $pendapatan = Transaksi::sum('jumlah_harga');
        $keuntungan = 0;
        foreach ($keuangan as $k) {
            $untung = $k->jumlah_harga - ($k->jumlah_beli * $k->produk->harga);
            $keuntungan += $untung;
        }

        return view('content.pemilik.keuangan.index', compact('keuangan', 'pendapatan', 'keuntungan'));
    }
}

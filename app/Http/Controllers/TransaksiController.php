<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function Transaksi(){
        $transaksi = Transaksi::where('status', 1)->get();

        return view('content.pemilik.transaksi.index', compact('transaksi'));
    }

    public function Keuangan(Request $request){
        $keuangan = Transaksi::orderBy('created_at', 'DESC')->get();
        $pendapatan = Transaksi::sum('jumlah_harga');
        if(!empty($request->input("range"))){
            $start_date=explode("-", $request->input('range'))[0];
            $end_date=explode("-", $request->input('range'))[1];
            $keuangan = Transaksi::whereDate("created_at", ">=", $start_date)->whereDate("created_at", "<=", $end_date)->orderBy('created_at', 'DESC')->get();
            $pendapatan = Transaksi::whereDate("created_at", ">=", $start_date)->whereDate("created_at", "<=", $end_date)->sum('jumlah_harga');//->get();
           // dd($keuangan);
        }

        //echo"<pre>"; print_r($pendapatan); echo"</pre>"; exit;
        // $keuntungan = 0;
        // foreach ($keuangan as $k) {
        //     $untung = $k->jumlah_harga - ($k->jumlah_beli * $k->produk->harga);
        //     $keuntungan += $untung;
        // }

        return view('content.pemilik.keuangan.index', compact('keuangan', 'pendapatan'));
    }
}

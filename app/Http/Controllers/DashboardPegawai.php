<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;

class DashboardPegawai extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $transaksi_detail = Transaksi_Detail::all();
        $transaksi = Transaksi::where('status', 0)->first();
        if (!empty($transaksi)) {
            $transaksi_detail  = Transaksi_Detail::where('transaksi_id', $transaksi->id)->get();
            return view('content.pegawai.index', compact('produks', 'transaksi', 'transaksi_detail'));
        }
        return view('content.pegawai.index', compact('produks', 'transaksi', 'transaksi_detail'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\KeuanganExport;
use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function Transaksi()
    {
        $transaksis = Transaksi::with('pegawai')->where('status', 1)->get();

        return view('content.pemilik.transaksi.index', compact('transaksis'));
    }

    public function Keuangan(Request $request)
    {
        $keuangan = Transaksi::orderBy('created_at', 'DESC')->get();
        $pendapatan = Transaksi::sum('jumlah_harga');
        if (!empty($request->input("range"))) {
            $start_date = explode("-", $request->input('range'))[0];
            $end_date = explode("-", $request->input('range'))[1];
            $keuangan = Transaksi::whereDate("created_at", ">=", $start_date)->whereDate("created_at", "<=", $end_date)->orderBy('created_at', 'DESC')->get();
            $pendapatan = Transaksi::whereDate("created_at", ">=", $start_date)->whereDate("created_at", "<=", $end_date)->sum('jumlah_harga'); //->get();
        }

        return view('content.pemilik.keuangan.index', compact('keuangan', 'pendapatan'));
    }

    public function cetakPDFTransaksi()
    {
        $transaksi = Transaksi::with('pegawai')->where('status', 1)->get();

        $pdf = PDF::loadview('content.pemilik.transaksi.laporan_pdf', compact('transaksi'));
        return $pdf->download('Laporan Transaksi');
    }

    public function cetakPDFKeuangan()
    {
        $keuangan = Transaksi::with('pegawai')->orderBy('created_at', 'DESC')->where('status', 1)->get();

        $pdf = PDF::loadview('content.pemilik.keuangan.laporan_pdf', compact('keuangan'));
        return $pdf->download('Laporan Keuangan');
    }

    public function cetakExcelTransaksi()
    {
        return Excel::download(new TransaksiExport, 'laporanTransaksi.xlsx');
    }

    public function cetakExcelKeuangan()
    {
        return Excel::download(new KeuanganExport, 'laporanKeuangan.xlsx');
    }
}

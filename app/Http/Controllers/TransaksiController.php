<?php

namespace App\Http\Controllers;

use App\Exports\KeuanganExport;
use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

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

    public function exportPDFTransaksi(Request $request)
    {
        if (!empty($request->start && $request->end)) {
            $pdf = Transaksi::with('pegawai')->orderBy('created_at', 'DESC')->where('status', 1)->whereDate("created_at", ">=", $request->start)->whereDate("created_at", "<=", $request->end)->get();
            $pdf = PDF::loadview('content.pemilik.transaksi.laporan_pdf', compact('pdf'));
            return $pdf->download('Laporan Transaksi');
        }
        return redirect()->back()->with('alert', 'Silahkan Isi Tanggal Dengan Benar Terlebih Dahulu Untuk Mencetak Riwayat Transaksi Format PDF !');
    }

    public function exportExcelTransaksi(Request $request)
    {
        if (!empty($request->start && $request->end)) {
            $start = $request->start;
            $end = $request->end;
            return Excel::download(new TransaksiExport($start, $end), 'laporanTransaksi.xlsx');
        }
        return redirect()->back()->with('alert', 'Silahkan Isi Tanggal Dengan Benar Terlebih Dahulu Untuk Mencetak Riwayat Transaksi Format EXCEL !');
    }

    public function exportPDFKeuangan(Request $request)
    {
        if (!empty($request->start && $request->end)) {
            $pdf = Transaksi::with('pegawai')->orderBy('created_at', 'DESC')->where('status', 1)->whereDate("created_at", ">=", $request->start)->whereDate("created_at", "<=", $request->end)->get();
            $pdf = PDF::loadview('content.pemilik.keuangan.laporan_pdf', compact('pdf'));
            return $pdf->download('Laporan Keuangan');
        }
        return redirect()->back()->with('alert', 'Silahkan Isi Tanggal Dengan Benar Terlebih Dahulu Untuk Mencetak Laporan Keuangan Format PDF !');
    }

    public function exportExcelKeuangan(Request $request)
    {
        if (!empty($request->start && $request->end)) {
            $start = $request->start;
            $end = $request->end;
            return Excel::download(new KeuanganExport($start, $end), 'laporanKeuangan.xlsx');
        }
        return redirect()->back()->with('alert', 'Silahkan Isi Tanggal Dengan Benar Terlebih Dahulu Untuk Mencetak Laporan Keuangan Format EXCEL !');
    }
}

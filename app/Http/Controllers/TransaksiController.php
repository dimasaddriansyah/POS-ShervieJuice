<?php

namespace App\Http\Controllers;

use App\Exports\KeuanganExport;
use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function Transaksi()
    {
        $transaksi = Transaksi::with('pegawai')->where('status', 1)->get();

        return view('content.pemilik.transaksi.index', compact('transaksi'));
    }

    public function Keuangan()
    {
        // SELECT created_at AS Tanggal, SUM(jumlah_harga) as Pendapatan FROM transaksi GROUP BY month(created_at);
        $keuangan = Transaksi::where('status', 1)->get();
        $cariBulan = Transaksi::whereMonth('created_at', '=', '3')->where('status', 1)->get();
        $pendapatan = Transaksi::where('status', 1)->get()->sum('jumlah_harga');

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

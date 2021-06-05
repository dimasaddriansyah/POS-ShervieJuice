<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransaksiExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        $transaksis = Transaksi::with('pegawai')->where('status', 1)->get();
        return view('content.pemilik.transaksi.excel', compact('transaksis'));
    }
}

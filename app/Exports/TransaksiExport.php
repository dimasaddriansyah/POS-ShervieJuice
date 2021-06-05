<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    public function view(): View
    {
        $transaksis = Transaksi::with('pegawai')->where('status', 1)->get();
        return view('content.pemilik.transaksi.excel', compact('transaksis'));
    }
}

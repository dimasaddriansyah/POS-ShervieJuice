<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KeuanganExport implements FromView
{
    public function view(): View
    {
        $keuangans = Transaksi::orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('content.pemilik.keuangan.excel', compact('keuangans'));
    }
}

<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KeuanganExport implements FromView, ShouldAutoSize
{
    protected $start;
    protected $end;

    function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $keuangans = Transaksi::orderBy('created_at', 'DESC')->where('status', 1)->whereDate("created_at", ">=", $this->start)->whereDate("created_at", "<=", $this->end)->get();
        return view('content.pemilik.keuangan.excel', compact('keuangans'));
    }
}

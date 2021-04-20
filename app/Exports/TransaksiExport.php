<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromCollection
{

    public function collection()
    {
        return Transaksi::with('pegawai')->where('status', 1)->get();
    }
}

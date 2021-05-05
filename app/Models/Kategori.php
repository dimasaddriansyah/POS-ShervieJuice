<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function transaksi_detail()
    {
        return $this->hasMany(Transaksi_Detail::class);
    }
}

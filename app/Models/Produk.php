<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = ['supplier_id',  'kategori_id', 'nama', 'stok', 'stok_masuk', 'harga'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function transaksi_detail()
    {
        return $this->hasMany(Transaksi_Detail::class);
    }

    public function getUpdatedAtAttribute()
    {
        \Carbon\Carbon::setLocale('id');
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pegawai';
    protected $fillable = ['nama', 'email', 'password', 'alamat', 'no_hp'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}

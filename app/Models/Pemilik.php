<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;

class Pemilik extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pemilik';
}

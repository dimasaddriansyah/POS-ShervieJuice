<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (Auth::guard('pemilik')->check()) {
            return redirect()->route('pemilik.dashboard');
        } else if (Auth::guard('pegawai')->check()) {
            return redirect()->route('kasir');
        }
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardPegawai;
use App\Http\Controllers\DashboardPemilik;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {

    return view('welcome');
});

Route::group(['middleware' => 'auth:pemilik'], function () {

    //Menghitung Data di Dashboard
    Route::get('/adminDashboard', [DashboardPemilik::class, 'dashboard'])->name('pemilik.dashboard');
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('produkMasuk', ProdukMasukController::class);
    Route::patch('addStok/{barang}', [ProdukMasukController::class, 'tambahStok'])->name('produkMasuk.tambahStok');
    Route::patch('editharga/{barang}', [ProdukMasukController::class, 'editHarga'])->name('produkMasuk.editHarga');
    Route::get('admin/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi.index');
    Route::get('admin/keuangan', [TransaksiController::class, 'keuangan'])->name('keuangan.index');
});

Route::group(['middleware' => 'auth:pegawai'], function () {

    Route::get('kasir', [DashboardPegawai::class, 'index'])->name('kasir');
    Route::post('add-transaksi', [DashboardPegawai::class, 'addTransaksi'])->name('kasir.tambahTransaksi');
    Route::get('delete-transaksi/{id}', [DashboardPegawai::class, 'deleteTransaksi']);

    Route::get('pegawai/konfirmasi/{id}', [DashboardPegawai::class, 'tampilKonfirmasi']);
    Route::post('add-konfirmasi/{id}', [DashboardPegawai::class, 'konfirmasi']);
    Route::get('cetak_pdf/{id}', [DashboardPegawai::class, 'cetak_pdf']);
});

Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

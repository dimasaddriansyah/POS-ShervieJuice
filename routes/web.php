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
    Route::get('cetakPDFTransaksi', [TransaksiController::class, 'cetakPDFTransaksi'])->name('transaksi.cetakPDF');
    Route::get('cetakExcelTransaksi', [TransaksiController::class, 'cetakExcelTransaksi'])->name('transaksi.cetakExcel');
    Route::get('admin/keuangan', [TransaksiController::class, 'keuangan'])->name('keuangan.index');
    Route::post('admin/keuangan', [TransaksiController::class, 'keuangan']);
    Route::get('cetakPDFKeuangan', [TransaksiController::class, 'cetakPDFKeuangan'])->name('keuangan.cetakPDF');
    Route::get('cetakExcelKeuangan', [TransaksiController::class, 'cetakExcelKeuangan'])->name('keuangan.cetakExcel');
});

Route::group(['middleware' => 'auth:pegawai'], function () {

    Route::get('kasir', [DashboardPegawai::class, 'index'])->name('kasir');
    Route::post('print', [DashboardPegawai::class, 'print'])->name('print');
    Route::post('tambah-transaksi/{produk}', [DashboardPegawai::class, 'tambahTransaksi'])->name('kasir.tambahTransaksi');
    Route::delete('delete-transaksi/{produk}', [DashboardPegawai::class, 'hapusTransaksi'])->name('kasir.hapusTransaksi');

    Route::get('konfirmasiTransaksi/{transaksi}', [DashboardPegawai::class, 'tampilKonfirmasi'])->name('kasir.tampilKonfirmasi');
    Route::post('konfirmasi/{transaksi}', [DashboardPegawai::class, 'konfirmasiTransaksi'])->name('kasir.konfirmasiTransaksi');
    Route::get('cetakPDF/{transaksi}', [DashboardPegawai::class, 'cetakPDF'])->name('kasir.cetakPDF');
});

Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');
    Route::get('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

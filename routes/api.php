<?php

use App\Http\Controllers\API\APIAuthController;
use App\Http\Controllers\API\APIKategoriController;
use App\Http\Controllers\API\APIPegawaiController;
use App\Http\Controllers\API\APIProdukController;
use App\Http\Controllers\API\APISupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('pegawai', [APIPegawaiController::class, 'index']);
Route::post('pegawaiPost', [APIPegawaiController::class, 'store']);
Route::get('supplier', [APISupplierController::class, 'index']);
Route::get('kategori', [APIKategoriController::class, 'index']);
Route::post('kategoriPost', [APIKategoriController::class, 'store']);
Route::get('produk', [APIProdukController::class, 'index']);

Route::post('loginPost', [APIAuthController::class, 'loginPost']);

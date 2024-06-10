<?php

use App\Http\Middleware\CekLeveladmin;
use App\Http\Middleware\CekLevelPelanggan;

use Illuminate\Support\Facades\Route;
//Sebelum Login, Tamu Bisa Melihat Isi Web, tetapi tidak bisa transaksi
Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');


Auth::routes();


// Route untuk menampilkan semua produk di file index
Route::get('/', [App\Http\Controllers\ProdukController::class, 'tampildataproduk'])->name('tampildataproduk');

Route::middleware(CekLeveladmin::class)->group(function () {
    Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'BerandaAdmin'])->name('beranda');
    Route::get('/pakanikan', [App\Http\Controllers\PakanIkanController::class, 'pakanikan'])->name('pakanikan');
});

Route::middleware(CekLevelPelanggan::class)->group(function () {
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'HalamUtamaPelanggan'])->name('HalamUtamaPelanggan');
    Route::get('/beli-produk', [App\Http\Controllers\ProdukController::class, 'beliProduk'])->name('beli-produk');

});

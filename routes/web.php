<?php

use App\Http\Middleware\CekLeveladmin;
use App\Http\Middleware\CekLevelPelanggan;
use Illuminate\Support\Facades\Route;


//AKSES UMUM
Route::get('/index', [App\Http\Controllers\Controller::class, 'tampildataproduk'])->name('tampildataproduk');
Route::get('/', [App\Http\Controllers\ProdukController::class, 'tampildataproduk'])->name('tampildataproduk');


//AKSES PENGGUNA
Auth::routes();

Route::middleware(CekLeveladmin::class)->group(function () {
    Route::get('/admin', [App\Http\Controllers\Controller::class, 'index'])->name('admin');
    Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'BerandaAdmin'])->name('beranda');
    Route::get('/pakanikan', [App\Http\Controllers\PakanIkanController::class, 'pakanikan'])->name('pakanikan');
    Route::get('/suhuair', [App\Http\Controllers\SuhuAirController::class, 'suhuair'])->name('suhuair');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('pelanggan');

    
});

Route::middleware(CekLevelPelanggan::class)->group(function () {
    Route::get('/index', [App\Http\Controllers\Controller::class, 'index'])->name('index');
    
    //KERANJANG
    Route::get('/produk/{id_produk}', [App\Http\Controllers\ProdukController::class, 'detailproduk'])->name('detailproduk');
    Route::post('/tambahproduk', [App\Http\Controllers\KeranjangController::class, 'TambahKeranjangDariDetail'])->name('tambahkankeranjang1');
    Route::get('/index/{id_produk}', [App\Http\Controllers\KeranjangController::class, 'TambahKeranjangLangsung'])->name('tambahkankeranjang2');
    Route::get('/keranjang', [App\Http\Controllers\KeranjangController::class, 'tampilkeranjang'])->name('keranjang');
    Route::delete('/keranjang/{id}/hapus', [App\Http\Controllers\KeranjangController::class, 'hapusItemKeranjang'])->name('hapusItemKeranjang');
    Route::post('/keranjang', [App\Http\Controllers\KeranjangController::class, 'keranjangkepesanan'])->name('keranjangkepesanan');

    //PEMBAYARAN
    Route::get('/pesanan', [App\Http\Controllers\PesananController::class, 'pesananbelumbayar'])->name('tampilpesananbelumbayar');
    Route::post('/bayarpesanan/{idpesanan}', [App\Http\Controllers\PesananController::class, 'bayarpesanan'])->name('bayarpesanan');

    Route::get('/sudahbayar', [App\Http\Controllers\PesananController::class, 'sudahbayar'])->name('tampildatasudahbayar');


    Route::get('/dikirim', [App\Http\Controllers\PesananController::class, 'dikirim'])->name('tampildatadikirim');
    Route::get('/dibatalkan', [App\Http\Controllers\PesananController::class, 'dibatalkan'])->name('tampildatadibatalkan');

});


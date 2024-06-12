<?php

use App\Http\Middleware\CekLeveladmin;
use App\Http\Middleware\CekLevelPelanggan;

use Illuminate\Support\Facades\Route;
//Sebelum Login, Tamu Bisa Melihat Isi Web, tetapi tidak bisa transaksi
Route::get('/index', [App\Http\Controllers\Controller::class, 'index'])->name('index');


Auth::routes();


// Route untuk menampilkan semua produk di file index
Route::get('/', [App\Http\Controllers\ProdukController::class, 'tampildataproduk'])->name('tampildataproduk');

Route::middleware(CekLeveladmin::class)->group(function () {
    Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'BerandaAdmin'])->name('beranda');
    Route::get('/pakanikan', [App\Http\Controllers\PakanIkanController::class, 'pakanikan'])->name('pakanikan');
});

Route::middleware(CekLevelPelanggan::class)->group(function () {
    Route::get('/produk/{id_produk}', [App\Http\Controllers\ProdukController::class, 'detailproduk'])->name('detailproduk');
    Route::post('/keranjang', [App\Http\Controllers\KeranjangController::class, 'TambahKeranjangDariDetail'])->name('tambahkankeranjang1');
    Route::post('/', [App\Http\Controllers\KeranjangController::class, 'TambahKeranjangLangsung'])->name('tambahkankeranjang2');
    Route::get('/keranjang', [App\Http\Controllers\KeranjangController::class, 'tampilkeranjang'])->name('keranjang');
    Route::delete('/keranjang/{id}/hapus', [App\Http\Controllers\KeranjangController::class, 'hapusItemKeranjang'])->name('hapusItemKeranjang');
});

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
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'Profile'])->name('Profile');
    Route::put('/profile/update', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('/admin', [App\Http\Controllers\Controller::class, 'index'])->name('admin');
    Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'BerandaAdmin'])->name('beranda');
    Route::get('/pakanikan', [App\Http\Controllers\PakanIkanController::class, 'pakanikan'])->name('pakanikan');
    Route::get('/suhuair', [App\Http\Controllers\SuhuAirController::class, 'suhuair'])->name('suhuair');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('tampilpelanggan');

    //PRODUK ALL
    Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'admintampildataproduk'])->name('tampilproduk');
    Route::put('/produk/{id}/ubah', [App\Http\Controllers\ProdukController::class, 'adminsimpanubahProduk'])->name('admin.ubahproduk');
    Route::post('/produk/{id}/ubah', [App\Http\Controllers\ProdukController::class, 'adminsimpanubahProduk'])->name('admin.simpanubahproduk');
    //SUB MENU TAMBAH PRODUK
    Route::get('/produk/tambahproduk', [App\Http\Controllers\ProdukController::class, 'formtambahproduk'])->name('admin.tambahproduk');
    Route::post('/produk/tambahproduk', [App\Http\Controllers\ProdukController::class, 'admintambahproduk'])->name('admin.simpanproduk');
    //SUB MENU TAMBAH JENIS PRODUK
    Route::get('/produk/tambahjenisikan', [App\Http\Controllers\ProdukController::class, 'formjenisproduk'])->name('admin.tambahjenis');
    Route::post('/produk/tambahjenisikan', [App\Http\Controllers\ProdukController::class, 'admintambahjenis'])->name('admin.simpanjenis');
    Route::delete('/produk/{id}/hapus', [App\Http\Controllers\ProdukController::class, 'hapusJenisProduk'])->name('admin.hapusjenis');

    //PESANAN ALL
    Route::get('/adminpesanan', [App\Http\Controllers\PesananController::class, 'admintampilpesanan'])->name('tampilpesanan');
    Route::get('/adminpesananditolak', [App\Http\Controllers\PesananController::class, 'admintampilpesananditolak'])->name('pesananditolak');
    Route::post('/adminpesanan/{id}/konfirmasi', [App\Http\Controllers\PesananController::class, 'adminkonfirmasiPembayaran'])->name('konfirmasi.pembayaran');
    Route::post('/adminpesanan/{id}/reject', [App\Http\Controllers\PesananController::class, 'adminrejectPembayaran'])->name('reject.pembayaran');

    //PENGIRIMAN
    Route::get('/belumkirim', [App\Http\Controllers\PengirimanController::class, 'belumkirim'])->name('admin.belumkirim');
    Route::get('/formkirim/{id}', [App\Http\Controllers\PengirimanController::class, 'kirimForm'])->name('admin.kirimForm');
    Route::post('/kirim/{id}', [App\Http\Controllers\PengirimanController::class, 'kirim'])->name('admin.kirimpesanan');
    Route::get('/sudahkirim', [App\Http\Controllers\PengirimanController::class, 'adminsudahkirim'])->name('admin.sudahkirim');
    Route::get('/sudahditerima', [App\Http\Controllers\PengirimanController::class, 'adminditerima'])->name('admin.sudahditerima');
});

Route::middleware(CekLevelPelanggan::class)->group(function () {
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'Profile'])->name('Profile');
    Route::put('/profile/update', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('/index', [App\Http\Controllers\Controller::class, 'index'])->name('index');

    //KERANJANG
    Route::get('/produk/{id_produk}', [App\Http\Controllers\ProdukController::class, 'detailproduk'])->name('detailproduk');
    Route::post('/tambahproduk', [App\Http\Controllers\KeranjangController::class, 'TambahKeranjangDariDetail'])->name('tambahkankeranjang1');
    Route::get('/index/{id_produk}', [App\Http\Controllers\KeranjangController::class, 'TambahKeranjangLangsung'])->name('tambahkankeranjang2');
    Route::get('/keranjang', [App\Http\Controllers\KeranjangController::class, 'tampilkeranjang'])->name('keranjang');
    Route::delete('/keranjang/{id}/hapus', [App\Http\Controllers\KeranjangController::class, 'hapusItemKeranjang'])->name('hapusItemKeranjang');
    Route::post('/keranjang', [App\Http\Controllers\KeranjangController::class, 'keranjangkepesanan'])->name('keranjangkepesanan');

    //PESANAN DAN PEMBAYARAN
    Route::get('/pesanan', [App\Http\Controllers\PesananController::class, 'pesananbelumbayar'])->name('tampilpesananbelumbayar');
    Route::post('/pesanan/{idpesanan}/dibatalkan', [App\Http\Controllers\PesananController::class, 'batalkanPesanan'])->name('batalkanpesanan');
    Route::post('/bayarpesanan/{idpesanan}', [App\Http\Controllers\PesananController::class, 'bayarpesanan'])->name('bayarpesanan');

    Route::get('/sudahbayar', [App\Http\Controllers\PesananController::class, 'sudahbayar'])->name('tampildatasudahbayar');

    Route::get('/dibatalkan', [App\Http\Controllers\PesananController::class, 'dibatalkan'])->name('tampildatadibatalkan');


    Route::get('/dikirim', [App\Http\Controllers\PengirimanController::class, 'Dikirim'])->name('tampildatadikirim');
    Route::post('/dikirim/{id}/terima', [App\Http\Controllers\PengirimanController::class, 'terimaPengiriman'])
        ->name('terimaPengiriman');
});

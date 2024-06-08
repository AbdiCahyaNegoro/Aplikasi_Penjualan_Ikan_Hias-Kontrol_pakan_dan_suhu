<?php

use App\Http\Middleware\CekLeveladmin;
use App\Http\Middleware\CekLevelPelanggan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::middleware(CekLeveladmin::class)->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'BerandaAdmin'])->name('beranda');
});

Route::middleware(CekLevelPelanggan::class)->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'HalamUtamaPelanggan'])->name('HalamUtamaPelanggan');
});

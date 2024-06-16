<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    

    public function pesanan()
    {
        $pesanan = DB::table('pesanan')
        ->leftJoin('pembayaran', 'pesanan.id_pesanan', '=', 'pembayaran.id_pesanan')
        ->leftJoin('pengiriman', 'pesanan.id_pesanan', '=', 'pengiriman.id_pesanan')
        ->select('pesanan.*')
        ->get();

    return view('market.pesanan', compact('pesanan'));
    }
}

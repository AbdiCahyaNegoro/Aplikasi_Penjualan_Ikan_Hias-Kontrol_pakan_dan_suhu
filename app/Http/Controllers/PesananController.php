<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function pesan()
    {
        // Lakukan validasi request
        $this->validate(request(), [
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Simpan pesanan baru ke dalam database
        $pesanan = new Pesanan();
        $pesanan->id_user = auth()->user()->id; // Ambil id pengguna yang terautentikasi
        $pesanan->id_produk = request('id_produk');
        $pesanan->jumlah = request('jumlah');
        $pesanan->tanggalpesanan = now(); // Tanggal pesanan saat ini
        $pesanan->statuspesanan = 'Belum Bayar'; // Atur status pesanan

        // Simpan pesanan ke dalam database
        $pesanan->save();

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }


    public function tambahkankeranjang()
    {
        // Ambil data keranjang dari database
        $keranjang = Keranjang::all();

        // Kirim data ke view
        return view('keranjang.index', compact('keranjang'));
    }
}

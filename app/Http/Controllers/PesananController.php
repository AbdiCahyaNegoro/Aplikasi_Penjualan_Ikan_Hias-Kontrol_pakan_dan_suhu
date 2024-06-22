<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\produk;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function __construct()
    {
        // Menambahkan middleware ke dalam controller untuk mengotentikasi pengguna
        $this->middleware('auth');
    }


    public function pesananbelumbayar()
    {
        $pesanan = DB::table('pesanan')
            ->leftJoin('pembayaran', 'pesanan.id_pesanan', '=', 'pembayaran.id_pesanan')
            ->leftJoin('pengiriman', 'pesanan.id_pesanan', '=', 'pengiriman.id_pesanan')
            ->select('pesanan.*', 'pembayaran.status as pembayaran_status', 'pengiriman.status as pengiriman_status')
            ->where('pesanan.status', '=', 'Belum Bayar')  // Menyaring pesanan dengan status "Belum Bayar"
            ->get();

        $detailPesanan = DB::table('detailpesanan')
            ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
            ->select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan', 'produk.folder', 'produk.nama_foto')
            ->get();

        return view('market.pesananbelumbayar', compact('pesanan', 'detailPesanan'));
    }


    public function bayarpesanan(Request $request, $idpesanan)
    {
        // Mengambil data pesanan berdasarkan id_pesanan yang diberikan
        $pesanan = DB::table('pesanan')->where('id_pesanan', $idpesanan)->first();
    
        // Memeriksa apakah pesanan ditemukan
        if ($pesanan) {
            // Memvalidasi input dari request
            $validated = $request->validate([
                'buktibayar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Menangani upload file bukti bayar
            if ($request->hasFile('buktibayar')) {
                $file = $request->file('buktibayar');
                $folderPath = 'public/assets/img/pembayaran';
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs($folderPath, $fileName, 'public');
            }
    
            // Menyimpan data pembayaran ke tabel pembayaran
            DB::table('pembayaran')->insert([
                'id_pesanan' => $idpesanan,
                'id_user' => auth()->id(), // Menggunakan ID user yang sedang login
                'status' => 'Menunggu Konfirmasi', // Status awal pembayaran
                'tanggal_pembayaran' => now(),
                'buktibayar' => $fileName,
                'folder' => $folderPath,
            ]);
    
            // Mengupdate status pesanan menjadi "Sudah Melakukan Pembayaran"
            DB::table('pesanan')->where('id_pesanan', $idpesanan)->update([
                'status' => 'Sudah Melakukan Pembayaran',
            ]);
    
            // Mengarahkan kembali atau memberikan respons
            return redirect()->route('tampilpesananbelumbayar')->with('success', 'Pesanan berhasil dibayar. Menunggu konfirmasi.');
        } else {
            // Jika pesanan tidak ditemukan, memberikan respons error
            return redirect()->route('tampilpesananbelumbayar')->with('error', 'Pesanan tidak ditemukan.');
        }
    }
        



    public function sudahbayar()
    {
        $detailPesanan = DB::table('detailpesanan')
        ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
        ->select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan', 'produk.folder', 'produk.nama_foto')
        ->get();

        $pembayaran = Pembayaran::all(); // Ambil semua data pembayaran

        return view('market.pesanansudahbayar', compact('pembayaran','detailPesanan'));
    }


    public function dikirim()
    {

        return view('market.pesanandikirim');
    }

    public function dibatalkan()
    {

        return view('market.pesanandibatalkan');
    }
}

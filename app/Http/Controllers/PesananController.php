<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\produk;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\Auth;
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
        $userId = Auth::user()->id; // Mendapatkan user_id dari pengguna yang sedang masuk

        $pesanan = DB::table('pesanan')
            ->leftJoin('pembayaran', 'pesanan.id_pesanan', '=', 'pembayaran.id_pesanan')
            ->leftJoin('pengiriman', 'pesanan.id_pesanan', '=', 'pengiriman.id_pesanan')
            ->select('pesanan.*', 'pembayaran.status as pembayaran_status', 'pengiriman.status as pengiriman_status')
            ->where('pesanan.status', '=', 'Belum Bayar')  // Menyaring pesanan dengan status "Belum Bayar"
            ->where('pesanan.id_user', '=', $userId)  // Menyaring pesanan sesuai dengan user yang masuk
            ->get();

        $detailPesanan = DB::table('detailpesanan')
            ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
            ->select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan', 'produk.folder', 'produk.nama_foto')
            ->whereIn('detailpesanan.id_pesanan', $pesanan->pluck('id_pesanan'))
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
            $request->validate([
                'buktibayar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Mendapatkan file yang diupload
            $file = $request->file('buktibayar');

            // Simpan file foto dengan nama sesuai nama produk
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('assets/img/pembayaran');

            // Cek apakah direktori tujuan ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Buat direktori jika tidak ada
            }

            // Pindahkan file ke direktori tujuan
            $file->move($destinationPath, $fileName);

            // Cek apakah file berhasil dipindahkan
            if (!file_exists($destinationPath . '/' . $fileName)) {
                return redirect()->route('tampilpesananbelumbayar')->with('error', 'Gagal mengunggah bukti pembayaran. Silakan coba lagi.');
            }

            // Menyimpan data pembayaran ke tabel pembayaran
            DB::table('pembayaran')->insert([
                'id_pesanan' => $idpesanan,
                'id_user' => auth()->id(), // Menggunakan ID user yang sedang login
                'status' => 'Menunggu Konfirmasi', // Status awal pembayaran
                'tanggal_pembayaran' => now(),
                'buktibayar' => $fileName,
                'folder' => 'assets/img/pembayaran/',
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

    public function batalkanPesanan($idpesanan)
    {
        DB::table('pesanan')
            ->where('id_pesanan', $idpesanan)
            ->update(['status' => 'Dibatalkan']);

        return redirect()->route('tampilpesananbelumbayar')->with('success', 'Pesanan berhasil dibatalkan.');
    }



    public function sudahbayar()
    {
        $userId = Auth::user()->id; // Mendapatkan user_id dari pengguna yang sedang masuk

        // Ambil semua data pembayaran oleh pengguna yang sedang masuk
        $pembayaran = DB::table('pembayaran')
            ->where('id_user', $userId)
            ->orderBy('tanggal_pembayaran', 'desc') // Mengurutkan berdasarkan tanggal pembayaran dari terbaru ke terlama
            ->get();

        // Ambil detail pesanan yang terkait dengan pesanan tersebut
        $detailPesanan = DB::table('detailpesanan')
            ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
            ->select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan', 'produk.folder', 'produk.nama_foto')
            ->whereIn('detailpesanan.id_pesanan', $pembayaran->pluck('id_pesanan'))
            ->get();

        return view('market.pesanansudahbayar', compact('pembayaran', 'detailPesanan'));
    }



    public function dikirim()
    {
        $userId = Auth::user()->id; // Mendapatkan user_id dari pengguna yang sedang masuk

        $pengiriman = DB::table('pengiriman')
            ->join('pesanan', 'pengiriman.id_pesanan', '=', 'pesanan.id_pesanan')
            ->where('pesanan.id_user', $userId)
            ->get();

        return view('market.pesanandikirim', compact('pengiriman'));
    }

    public function dibatalkan()
    {
        $userId = Auth::user()->id; // Mendapatkan user_id dari pengguna yang sedang masuk

        $dibatalkan = DB::table('pesanan')
            ->join('users', 'pesanan.id_user', '=', 'users.id')
            ->where('pesanan.status', 'Dibatalkan')
            ->where('pesanan.id_user', $userId)
            ->get();

        return view('market.pesanandibatalkan', compact('dibatalkan'));
    }

    public function admintampilpesanan()
    {
        $pembayaranMenungguKonfirmasi = DB::table('pembayaran')
            ->select('pembayaran.*', 'users.name as user_name')
            ->leftJoin('users', 'pembayaran.id_user', '=', 'users.id')
            ->leftJoin('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
            ->where('pembayaran.status', 'Menunggu Konfirmasi')
            ->distinct() // Menggunakan DISTINCT untuk menghilangkan baris ganda
            ->get();


        $detailPesanan = DB::table('detailpesanan')
            ->select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan')
            ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
            ->distinct() // Menggunakan DISTINCT untuk menghilangkan baris ganda
            ->get();

        return view('admin.Pesanan', compact('pembayaranMenungguKonfirmasi', 'detailPesanan'));
    }


    public function admintampilpesananditolak()
    {
        $pembayaranMenungguKonfirmasi = DB::table('pembayaran')
            ->select('pembayaran.*', 'users.name as user_name')
            ->leftJoin('users', 'pembayaran.id_user', '=', 'users.id')
            ->leftJoin('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
            ->where('pembayaran.status', 'Pembayaran Ditolak')
            ->distinct() // Menggunakan DISTINCT untuk menghilangkan baris ganda
            ->get();

        return view('admin.PesananDitolak', compact('pembayaranMenungguKonfirmasi'));
    }


    public function adminkonfirmasiPembayaran(Request $request, $id)
    {
        // Update status pembayaran
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'Pembayaran Sukses';
        $pembayaran->save();
    
        // Simpan data pengiriman
        $pengirimanData = [
            'id_pesanan' => $pembayaran->id_pesanan,
            'tanggal_pengiriman' => now(), 
            'status' => 'Belum Dikirim',
            'nama_foto_resi' => "", 
            'folder' => 'assets/img/resi',
        ];
    
        Pengiriman::create($pengirimanData);
    
        return redirect()->back()->with('success', 'Pembayaran Diterima.');
    }


    public function adminrejectPembayaran(Request $request, $id)
    {
        // Update status pesanan menjadi Pembayaran Ditolak
        DB::table('pembayaran')->where('id_pembayaran', $id)->update([
            'status' => 'Pembayaran Ditolak',
        ]);

        return redirect()->back()->with('success', 'Pembayaran Ditolak.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{

    public function __construct()
    {
        // Menambahkan middleware ke dalam controller untuk mengotentikasi pengguna
        $this->middleware('auth');
    }


       public function TambahKeranjangDariDetail(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Dapatkan ID pengguna yang saat ini masuk
        $userId = auth()->id();

        // Dapatkan ID produk dari request
        $productId = $request->input('product_id');

        // Dapatkan produk berdasarkan ID
        $produk = Produk::find($productId);

        // Periksa apakah stok mencukupi
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Kurangi stok produk
        $produk->stok -= $request->jumlah;
        $produk->save();

        // Tambahkan produk yang dipesan ke tabel keranjang
        DB::table('keranjang')->insert([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $request->jumlah,
        ]);

        // Redirect kembali ke halaman sebelumnya atau halaman keranjang belanja
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang. <a href="' . route('keranjang') . '">Cek Keranjang</a>');
    }

    public function TambahKeranjangLangsung($id_produk)
    {
        // Dapatkan ID pengguna yang saat ini masuk
        $userId = auth()->id();

        // Dapatkan produk berdasarkan ID
        $produk = Produk::find($id_produk);

        // Periksa apakah stok mencukupi
        if ($produk->stok < 1) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Kurangi stok produk
        $produk->stok -= 1;
        $produk->save();

        // Cek apakah produk sudah ada di keranjang pengguna
        $cekkeranjang = Keranjang::where('user_id', $userId)
            ->where('product_id', $id_produk)
            ->first();

        if ($cekkeranjang) {
            // Jika produk sudah ada, tingkatkan jumlahnya
            $cekkeranjang->increment('quantity', 1);
        } else {
            // Jika produk belum ada, tambahkan ke keranjang
            Keranjang::create([
                'user_id' => $userId,
                'product_id' => $id_produk,
                'quantity' => '1',
            ]);
        }

        // Redirect kembali ke halaman sebelumnya atau halaman keranjang belanja
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function tampilkeranjang()
    {
        // Ambil semua data produk dari database
        $keranjang = DB::table('keranjang')
            ->leftJoin('produk', 'keranjang.product_id', '=', 'produk.id_produk')
            ->select('keranjang.*', 'produk.nama_produk', 'produk.harga_satuan')
            ->where('keranjang.user_id', auth()->id())
            ->get();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($keranjang as $item) {
            $totalHarga += $item->quantity * $item->harga_satuan;
        }

        // Kirim data ke view
        return view('market.keranjang', compact('keranjang', 'totalHarga'));
    }

    public function hapusItemKeranjang($id_keranjang)
    {
        // Temukan item keranjang berdasarkan ID
        $keranjanghapus = Keranjang::find($id_keranjang)->delete();

        // Jika item tidak ditemukan, redirect kembali ke halaman keranjang dengan pesan error
        return redirect()->route('keranjang')->with('error', 'Item tidak ditemukan dalam keranjang.');
    }
}

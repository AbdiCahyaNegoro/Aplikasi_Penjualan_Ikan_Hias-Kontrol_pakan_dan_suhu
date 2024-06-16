<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Keranjang;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{

    public function __construct()
    {
        // Menambahkan middleware ke dalam controller untuk mengotentikasi pengguna
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index');
    }

    public function TambahKeranjangDariDetail(Request $request )
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Dapatkan ID pengguna yang saat ini masuk
        $userId = auth()->id();

        // Dapatkan ID produk dari request
        $productId = $request->input('id_produk');
        $jumlah = $request->input('jumlah');

        // Dapatkan produk berdasarkan ID
        $produk = Produk::find($productId);

        // Periksa apakah stok mencukupi
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }


        // Cek apakah produk sudah ada di keranjang pengguna
        $keranjang = Keranjang::where('id_user', $userId)
            ->where('id_produk', $productId)
            ->first();

        if ($keranjang) {
            // Jika produk sudah ada, tingkatkan jumlahnya
            $keranjang->increment('quantity', $jumlah);
        } else {
            // Tambahkan produk yang dipesan ke tabel keranjang
            DB::table('keranjang')->insert([
                'id_user' => $userId,
                'id_produk' => $productId,
                'quantity' => $request->jumlah,
            ]);
        }
        // Kurangi stok produk
        $produk->stok -= $request->jumlah;
        $produk->save();
        // Redirect kembali ke halaman sebelumnya atau halaman keranjang belanja
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang. Cek Keranjang');
    }

    public function TambahKeranjangLangsung(Request $request, $id_produk)
    {
        // Validasi request di sini jika diperlukan

        // Dapatkan ID pengguna yang saat ini masuk
        $userId = auth()->id();

        // Dapatkan produk berdasarkan ID
        $produk = Produk::find($id_produk);

        // Periksa apakah produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Periksa apakah stok mencukupi
        if ($produk->stok < 1) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Cek apakah produk sudah ada di keranjang pengguna
        $keranjang = Keranjang::where('id_user', $userId)
            ->where('id_produk', $id_produk)
            ->first();

        if ($keranjang) {
            // Jika produk sudah ada, tingkatkan jumlahnya
            $keranjang->increment('quantity', 1);
        } else {
            // Jika produk belum ada, tambahkan ke keranjang
            DB::table('keranjang')->insert([
                'id_user' => $userId,
                'id_produk' => $id_produk,
                'quantity' => 1,
            ]);
        }

        // Kurangi stok produk
        $produk->stok -= 1;
        $produk->save();

        // Respon berhasil
        return redirect()->route('index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }



    public function tampilkeranjang()
    {
        // Ambil semua data produk dari database
        $keranjang = Keranjang::leftJoin('produk', 'keranjang.id_produk', '=', 'produk.id_produk')
            ->leftJoin('jenisproduk', 'produk.jenisproduk_id', '=', 'jenisproduk.id_jenisproduk')
            ->select('keranjang.*', 'produk.*', 'jenisproduk.*') // Ambil semua kolom dari ketiga tabel
            ->where('keranjang.id_user', auth()->id())
            ->get();


        // Kirim data ke view
        return view('market.keranjang', compact('keranjang'));
    }




    public function hapusItemKeranjang($id_keranjang)
    {
        // Temukan item keranjang berdasarkan ID
        $itemKeranjang = Keranjang::find($id_keranjang);

        // Periksa apakah item keranjang ditemukan
        if ($itemKeranjang) {
            // Kembalikan jumlah stok produk
            $produk = Produk::find($itemKeranjang->id_produk);
            $produk->stok += $itemKeranjang->quantity;
            $produk->save();

            // Hapus item dari keranjang
            $itemKeranjang->delete();

            // Redirect kembali ke halaman keranjang dengan pesan sukses
            return redirect()->route('keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        // Jika item tidak ditemukan, redirect kembali ke halaman keranjang dengan pesan error
        return redirect()->route('keranjang')->with('error', 'Item tidak ditemukan dalam keranjang.');
    }


    
    public function keranjangkepesanan(Request $request)
    {
        // Dapatkan ID pengguna yang saat ini masuk
        $userId = auth()->id();

        // Ambil semua item di keranjang pengguna
        $keranjangItems = Keranjang::where('id_user', $userId)->get();

        // Hitung total harga
        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->quantity * $item->produk->harga_satuan;
        });

        // Buat pesanan baru
        $pesanan = Pesanan::create([
            'id_user' => $userId,
            'tanggalpesanan' => now(),
            'status' => 'Belum Bayar',
            'total_harga' => $totalHarga,
        ]);

        // Pindahkan item dari keranjang ke detail pesanan
        foreach ($keranjangItems as $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id_pesanan,
                'id_produk' => $item->id_produk,
                'quantity' => $item->quantity,
                'harga_satuan' => $item->produk->harga_satuan,
            ]);

            // Hapus item dari keranjang
            $item->delete();
        }

        // Redirect ke halaman pesanan atau halaman lain yang diinginkan
        return redirect()->route('keranjang')->with('success', 'Pesanan berhasil dibuat.');
    }
}

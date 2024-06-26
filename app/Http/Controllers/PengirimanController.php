<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PengirimanController extends Controller
{
    public function __construct()
    {
        // Menambahkan middleware ke dalam controller untuk mengotentikasi pengguna
        $this->middleware('auth');
    }

    public function belumkirim()
    {
        // Ambil data pengiriman yang belum dikirim
        $pengiriman = Pengiriman::where('status', 'Belum Dikirim')->get();

        // Ambil detail pesanan yang terkait dengan pengiriman tersebut
        $detailPesanan = DetailPesanan::select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan')
            ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
            ->whereIn('detailpesanan.id_pesanan', $pengiriman->pluck('id_pesanan')->toArray())
            ->distinct()
            ->get();

        // Ambil data pembayaran untuk informasi tambahan jika diperlukan
        $pembayaran = Pembayaran::all();

        // Ambil data pelanggan untuk informasi tambahan jika diperlukan
        $pelanggan = User::all();

        return view('admin.belumkirim', compact('pengiriman', 'detailPesanan', 'pembayaran', 'pelanggan'));
    }


    public function kirimForm($id_pengiriman)
    {
        // Ambil data pengiriman berdasarkan $id_pengiriman
        $pengiriman = Pengiriman::findOrFail($id_pengiriman);

        // Ambil data pesanan terkait
        $pesanan = Pesanan::findOrFail($pengiriman->id_pesanan);

        // Ambil data pemesan (user) berdasarkan id_user dari pesanan
        $pemesan = User::findOrFail($pesanan->id_user);

        // Ambil detail pesanan terkait dengan pengiriman tersebut
        $detailPesanan = DetailPesanan::select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan')
            ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
            ->where('detailpesanan.id_pesanan', $pengiriman->id_pesanan)
            ->get();
        return view('admin.formkirim', compact('pengiriman', 'pemesan', 'detailPesanan'));
    }


    public function kirim(Request $request, $id_pengiriman)
    {

        // Validasi input jika diperlukan
        $request->validate([
            'tanggal_pengiriman' => 'required|date',
            'foto_resi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan foto resi
        $fotoResi = $request->file('foto_resi');
        $folder = 'assets/img/resi';
        $fileName = time() . '_' . $fotoResi->getClientOriginalName();
        $path = $fotoResi->storeAs($folder, $fileName);

        // Update status pengiriman
        $pengiriman = Pengiriman::findOrFail($id_pengiriman);
        $pengiriman->tanggal_pengiriman = $request->tanggal_pengiriman;
        $pengiriman->status = 'Dikirim';
        $pengiriman->nama_foto_resi = $fileName; // Simpan nama file foto resi
        $pengiriman->folder = $folder; // Simpan folder tempat menyimpan foto resi
        $pengiriman->save();

        return redirect()->back()->with('success', 'Pengiriman berhasil dikirim.');
    }


    public function adminsudahkirim()
    {
        // Ambil semua pengiriman dengan status 'Dikirim'
        $pengirimanList = Pengiriman::where('status', 'Dikirim')->get();

        // Ambil data pesanan terkait dan detail pesanan dalam view
        $pengirimanList->each(function ($pengiriman) {
            $pengiriman->pesanan = Pesanan::findOrFail($pengiriman->id_pesanan);
            $pengiriman->detailPesanan = DetailPesanan::select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan')
                ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
                ->where('detailpesanan.id_pesanan', $pengiriman->id_pesanan)
                ->get();
        });

        return view('admin.dikirim', compact('pengirimanList'));
    }


    public function adminditerima()
    {
        $pengiriman = Pengiriman::where('status', 'Diterima')
            ->get();

        return view('admin.Diterima', compact('pengiriman'));
    }

    public function Dikirim()
    {
        // Ambil semua pengiriman dengan status 'Dikirim' atau 'Diterima' untuk pelanggan yang sedang login
        $pengirimanList = Pengiriman::select('pengiriman.*', 'pesanan.id_user')
            ->join('pesanan', 'pengiriman.id_pesanan', '=', 'pesanan.id_pesanan')
            ->where(function ($query) {
                $query->where('pengiriman.status', 'Dikirim')
                    ->orWhere('pengiriman.status', 'Diterima');
            })
            ->where('pesanan.id_user', Auth::id())
            ->get();

        // Ambil data detail pesanan dalam view
        $pengirimanList->each(function ($pengiriman) {
            $pengiriman->detailPesanan = DetailPesanan::select('detailpesanan.*', 'produk.nama_produk', 'produk.harga_satuan')
                ->leftJoin('produk', 'detailpesanan.id_produk', '=', 'produk.id_produk')
                ->where('detailpesanan.id_pesanan', $pengiriman->id_pesanan)
                ->get();
        });

        return view('market.pesanandikirim', compact('pengirimanList'));
    }


    public function terimaPengiriman(Request $request, $id_pengiriman)
    {
        // Temukan pengiriman berdasarkan ID
        $pengiriman = Pengiriman::findOrFail($id_pengiriman);

        // Ubah status pengiriman menjadi 'Diterima'
        $pengiriman->status = 'Diterima';
        $pengiriman->save();

        // Redirect atau kembalikan respons ke halaman sebelumnya
        return redirect()->back()->with('success', 'Status pengiriman berhasil diubah.');
    }
}

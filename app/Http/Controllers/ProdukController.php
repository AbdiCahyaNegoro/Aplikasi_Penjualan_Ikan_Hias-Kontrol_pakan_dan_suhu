<?php

namespace App\Http\Controllers;

use App\Models\produk;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function create()
    {
    }

    public function tampildataproduk()
    {
        // Ambil semua data produk dari database
        $produk = produk::all();

        // Kirim data ke view
        return view('index', compact('produk'));
    }


    public function edit(produk $produk)
    {
    }

    public function detailproduk($idproduk)
    {
        // Ambil Data Produk
        $produk = Produk::where('produk.id_produk', $idproduk)
        ->leftjoin('jenisproduk', 'produk.jenisproduk_id', '=', 'jenisproduk.id_jenisproduk')
        ->first();

        // Jika data produk ditemukan
        if ($produk) {
            // Kembalikan view dengan detail produk
            return view('market.detailproduk', ['produk' => $produk]);
        } else {
            // Jika data produk tidak ditemukan, kembalikan halaman error atau tindakan yang sesuai
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function destroy(produk $produk)
    {
        //
    }
    public function beliProduk()
    {
        return view('market.pesan');
    }

   
    
}

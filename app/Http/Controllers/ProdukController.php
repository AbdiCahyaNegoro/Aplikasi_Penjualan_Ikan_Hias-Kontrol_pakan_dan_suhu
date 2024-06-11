<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */  
    public function tampildataproduk()
    {
        // Ambil semua data produk dari database
        $produk = produk::all();

        // Kirim data ke view
        return view('index', compact('produk'));
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        //
    }

    public function detailproduk($idproduk)
        {
            // Ambil data pegawai berdasarkan NIP dan nama jabatan pegawai
            $produk = produk::where('id_produk', $idproduk)->first();
        
            // Jika data produk ditemukan
            if ($produk) {
                // Kembalikan view dengan detail produk
                return view('market.detailproduk', ['produk' => $produk]);
            } else {
                // Jika data produk tidak ditemukan, kembalikan halaman error atau tindakan yang sesuai
                return redirect()->back()->with('error', 'Produk tidak ditemukan.');
            }
        }   
 /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk $produk)
    {
        //
    }
    public function beliProduk()
    {
        return view('market.pesan');
    }

}

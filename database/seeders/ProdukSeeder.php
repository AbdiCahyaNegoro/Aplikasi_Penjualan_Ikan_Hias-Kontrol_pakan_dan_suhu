<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk1 = new produk;
        $produk1->nama_produk = "Glow Fish";
        $produk1->harga_satuan = 2000;
        $produk1->stok = 100;
        $produk1->jenisproduk_id = 1 ;
        $produk1->deskripsiproduk = "Ikannya Lucu";
        $produk1->nama_foto = "GlowFish.jpg";
        $produk1->folder = 'assets/img/produk';
        $produk1->save();

        $produk2 = new produk;
        $produk2->nama_produk = "Neon Tetra";
        $produk2->harga_satuan = 5000;
        $produk2->stok = 100;
        $produk2->jenisproduk_id = 2 ;
        $produk2->deskripsiproduk = "Ikannya Sehat";
        $produk2->nama_foto = "Tetra.jpg";
        $produk2->folder = 'assets/img/produk';
        $produk2->save();
    }
}

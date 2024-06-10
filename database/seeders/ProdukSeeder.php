<?php

namespace Database\Seeders;

use App\Models\produk;
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
        $produk1->nama_produk = "Ikan Sapu Sapu";
        $produk1->harga_satuan = 2000;
        $produk1->stok = 2;
        $produk1->jenisproduk = 'Ikan Air Tawar';
        $produk1->deskripsiproduk = "Ikannya Lucu";
        $produk1->nama_foto = "Ikansapusapu.jpg";
        $produk1->folder = 'assets/img/produk';
        $produk1->save();

        $produk2 = new produk;
        $produk2->nama_produk = "Ikan Mas";
        $produk2->harga_satuan = 5000;
        $produk2->stok = 5;
        $produk2->jenisproduk = 'Ikan Air Tawar';
        $produk2->deskripsiproduk = "Ikannya Sehat";
        $produk2->nama_foto = "IkanMas.jpg";
        $produk2->folder = 'assets/img/produk';
        $produk2->save();
    }
}

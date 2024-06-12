<?php

namespace Database\Seeders;

use App\Models\jenisproduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisprodukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Cupang";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Guppy";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Neon Tetra";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Discus";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Koi";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Molly";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Platy";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Angelfish";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Corydoras";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Swordtail";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Zebra Danio";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Black Ghost";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Oscar";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Flowerhorn";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Arwana";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Manfish";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Rasbora";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Betta";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Goldfish";
        $jenisproduk->save();

        $jenisproduk = new jenisproduk();
        $jenisproduk->jenis = "Barbus";
        $jenisproduk->save();
    }
}

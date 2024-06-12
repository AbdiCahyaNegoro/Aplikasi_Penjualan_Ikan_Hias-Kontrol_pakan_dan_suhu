<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detailpesanan', function (Blueprint $table) {
            $table->increments('id_detailpesanan');
            $table->unsignedInteger('id_pesanan');
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->integer('qty');
            $table->decimal('harga_satuan',10,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpesanan');
    }
};

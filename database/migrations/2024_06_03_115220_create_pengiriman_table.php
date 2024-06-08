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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->increments('id_pengiriman');
            $table->unsignedInteger('id_pesanan');
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
            $table->date('tanggal_pengiriman');
            $table->enum('status',['Belum Dikirim','Dikirim']);
            $table->string('foto_resi');
            $table->string('folder',50);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};

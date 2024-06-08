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
        Schema::create('pakanikaniot', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu');
            $table->integer('TakaranPakan'); //1 10 gram , 2 20 gram , 3 30 gram , 4 40 gram , 5 50 gram
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakanikaniot');
    }
};

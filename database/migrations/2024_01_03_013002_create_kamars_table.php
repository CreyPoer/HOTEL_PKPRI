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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_kamar');
            $table->string('jenis_kamar');
            $table->integer('harga_permalam');
            $table->integer('kapasitas');
            $table->string('bed');
            $table->string('pendingin_ruangan');
            $table->string('tv');
            $table->string('kamar_mandi');
            $table->string('peralatan_mandi');
            $table->string('breakfast');
            $table->integer('ketersediaan');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};

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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('aktors');
            $table->foreignId('pemesanan_id')->constrained('pemesanans');
            $table->date('tgl_bayar')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->integer('jumlah_pembayaran')->nullable();
            $table->integer('jumlah_dp')->nullable();
            $table->string('rek_tujuan')->nullable();
            $table->string('no_rek_tujuan')->nullable();
            $table->string('rek_asal')->nullable();
            $table->string('no_rek_asal')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};

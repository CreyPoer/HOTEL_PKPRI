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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('aktors');
            $table->foreignId('kamar_id')->constrained('kamars');
            $table->date('tgl_pesan');
            $table->date('tenggat_bayar')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('lama_inap');
            $table->integer('jumlah_kamar');
            $table->integer('total_harga');
            $table->integer('biaya_tambahan')->nullable();
            $table->string('status_checkin');
            $table->string('status_pesan');
            $table->string('status_ulasan');
            $table->string('status_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};

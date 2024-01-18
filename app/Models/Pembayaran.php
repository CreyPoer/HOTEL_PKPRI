<?php

namespace App\Models;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $guards = [];
    protected $fillable=['id','pelanggan_id','pemesanan_id','tgl_bayar','metode_pembayaran','jumlah_pembayaran','jumlah_dp','rek_tujuan','no_rek_tujuan','rek_asal','no_rek_asal','atas_nama','bukti_transfer'];
    public function aktor()
    {
        return $this->belongsTo(Aktor::class,'pelanggan_id');
    }
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

}

// $table->id();
// $table->foreignId('pelanggan_id')->constrained('aktors');
// $table->foreignId('pemesanan_id')->constrained('pemesanans');
// $table->date('tgl_bayar')->nullable();
// $table->string('metode_pembayaran')->nullable();
// $table->integer('jumlah_pembayaran')->nullable();
// $table->integer('jumlah_dp')->nullable();
// $table->string('rek_tujuan')->nullable();
// $table->string('no_rek_tujuan')->nullable();
// $table->string('rek_asal')->nullable();
// $table->string('no_rek_asal')->nullable();
// $table->string('atas_nama')->nullable();
// $table->string('bukti_transfer')->nullable();
// $table->string('status_pembayaran')->nullable();
// $table->timestamps();

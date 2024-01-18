<?php

namespace App\Models;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';
    protected $guards = [];
    protected $fillable=['id','pelanggan_id','kamar_id','tgl_pesan','tenggat_bayar','check_in','check_out','lama_inap','jumlah_kamar','total_harga','biaya_tambahan','status_checkin','status_pesan','status_ulasan','status_pembayaran'];
    public function aktor()
    {
        return $this->belongsTo(Aktor::class,'pelanggan_id');
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

}
// $table->id();
// $table->foreignId('pelanggan_id')->constrained('aktors');
// $table->foreignId('kamar_id')->constrained('kamars');
// $table->date('tgl_pesan');
// $table->date('check_in');
// $table->date('check_out');
// $table->integer('lama_inap');
// $table->integer('jumlah_kamar');
// $table->integer('total_harga');
// $table->integer('status_pesan');
// $table->integer('status_ulasan');

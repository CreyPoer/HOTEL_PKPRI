<?php

namespace App\Models;
use App\Models\Testimoni;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktor extends Model
{
    use HasFactory;

    protected $table = 'aktors';
    protected $guards = [];
    protected $fillable=['id','no_ktp','nama','jenis_kelamin','alamat','no_telp','email','password','image','role'];

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class,'pelanggan_id');
    }
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'pelanggan_id');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class,'pelanggan_id');
    }


}

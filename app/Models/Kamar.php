<?php

namespace App\Models;
use App\Models\Testimoni;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamars';
    protected $guards = [];
    protected $fillable=['id','kategori_kamar','jenis_kamar','harga_permalam','kapasitas','bed','pendingin_ruangan','tv','kamar_mandi','peralatan_mandi','breakfast','ketersediaan','image'];
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
    public function testimoni()
    {
        return $this->hasMany(Testimoni::class);
    }
}

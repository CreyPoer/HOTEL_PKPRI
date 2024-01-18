<?php

namespace App\Models;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekenings';
    protected $guards = [];
    protected $fillable=['id','rek_tujuan','no_rek_tujuan','atas_nama'];
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }


}

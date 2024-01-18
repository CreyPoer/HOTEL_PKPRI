<?php

namespace App\Models;
use App\Models\Aktor;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;
    protected $table = 'testimonis';
    protected $guards = [];
    protected $fillable=['id','pelanggan_id','kamar_id','rating','ulasan'];
    public function aktor()
    {
        return $this->belongsTo(Aktor::class,'pelanggan_id');
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}

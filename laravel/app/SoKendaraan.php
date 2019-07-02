<?php

namespace App;

use App\Merek;
use App\SoPelanggan;
use App\SoTransaksi;
use App\SoTransaksiBarang;

use Illuminate\Database\Eloquent\Model;

class SoKendaraan extends Model
{
    protected $guarded = [];
    
    public function SoTransaksi()
    {
        return $this->hasMany('SoTransaksi');
    }
    public function PoTransaksiBarang()
    {
        return $this->hasMany('PoTransaksiBarang');
    }
    public function SoPelanggan()
    {
        return $this->belongsTo(SoPelanggan::class);
    }
    public function Merek()
    {
        return $this->belongsTo(Merek::class);
    }

    
}

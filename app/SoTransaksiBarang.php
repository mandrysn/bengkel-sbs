<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\PoTransaksiBarang;
use App\SoTransaksi;
use App\Barang;
use App\Suplier;

class SoTransaksiBarang extends Model
{
    protected $guarded = [];
    
    public function SoTransaksi()
    {
        return $this->belongsTo(SoTransaksi::class);
    }
    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function Suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function PoTransaksiBarang()
    {
        return $this->hasMany('PoTransaksiBarang');
    }
}

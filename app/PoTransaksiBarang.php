<?php

namespace App;

use App\Barang;
use App\SoTransaksiBarang;
use Illuminate\Database\Eloquent\Model;

class PoTransaksiBarang extends Model
{
    protected $guarded = [];
    
    public function SoTransaksiBarang()
    {
        return $this->belongsTo(SoTransaksiBarang::class);
    }
    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

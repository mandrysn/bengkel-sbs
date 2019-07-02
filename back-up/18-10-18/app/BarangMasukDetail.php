<?php

namespace App;

use App\Barang;
use App\Suplier;
use App\BarangMasuk;
use App\PoTransaksiBarang;
use App\SoTransaksiBarang;
use Illuminate\Database\Eloquent\Model;

class BarangMasukDetail extends Model
{
    protected $guarded = [];

    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function Suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function BarangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class);
    }
    public function PoTransaksiBarang()
    {
        return $this->belongsTo(PoTransaksiBarang::class);
    }
    public function SoTransaksiBarang()
    {
        return $this->belongsTo(SoTransaksiBarang::class);
    }
}

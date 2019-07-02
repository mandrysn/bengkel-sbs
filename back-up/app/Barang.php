<?php

namespace App;

use App\Merek;
use App\Satuan;
use App\BarangMasuk;
use App\PoTransaksi;
use App\MaTransaksiDetail;
use App\MaterialBarang;
use App\SoTransaksiBarang;
use App\BuktiMaterialDetail;
use App\BuktiKeluarDetail;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = [];

    public function Merek()
    {
        return $this->belongsTo(Merek::class);
    }
    public function Satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function Gudang()
    {
        return $this->hasMany('Gudang');
    }
    public function SoTransaksiBarang()
    {
        return $this->hasMany('SoTransaksiBarang');
    }
    public function MaterialBarang()
    {
        return $this->hasMany('MaterialBarang');
    }
    public function MaTransaksiDetail()
    {
        return $this->hasMany('MaTransaksiDetail');
    }
    public function PoTransaksi()
    {
        return $this->hasMany('PoTransaksi');
    }
    public function BuktiMaterialDetail()
    {
        return $this->hasMany('BuktiMaterialDetail');
    }
    public function BarangMasukDetail()
    {
        return $this->hasMany('BarangMasukDetail');
    }
    public function BarangKeluarDetail()
    {
        return $this->hasMany('BarangKeluarDetail');
    }
    public function BuktiKeluarDetail()
    {
        return $this->hasMany('BuktiKeluarDetail');
    }
}

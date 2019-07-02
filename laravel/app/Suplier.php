<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SoTransaksiBarang;
use App\PoTransaksi;
use App\Utang;
use App\Material;
use App\BarangMasukDetail;
use App\BuktiMaterialDetail;

class Suplier extends Model
{
    protected $guarded = [];
    
    public function SoTransaksiBarang()
    {
        return $this->hasMany('SoTransaksiBarang');
    }
    public function PoTransaksi()
    {
        return $this->hasMany('PoTransaksi');
    }
    public function Material()
    {
        return $this->hasMany('Material');
    }
    public function Gudang()
    {
        return $this->hasMany('Gudang');
    }
    public function BarangKeluarDetail()
    {
        return $this->hasMany('BarangKeluarDetail');
    }
    public function BarangMasukDetail()
    {
        return $this->hasMany('BarangMasukDetail');
    }
    public function BuktiMaterialDetail()
    {
        return $this->hasMany('BuktiMaterialDetail');
    }
    public function BuktiKeluarDetail()
    {
        return $this->hasMany('BuktiKeluarDetail');
    }
    public function Utang()
    {
        return $this->hasOne('Utang');
    }
}
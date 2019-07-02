<?php

namespace App;

use App\Barang;
use App\SoKendaraan;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $guarded = [];

    public function Barang()
    {
        return $this->hasMany('Barang');
    }
    public function SoKendaraan()
    {
        return $this->hasMany('SoKendaraan');
    }
    public function getNamaMerekAttribute($nama_merek)
    {
        return ucwords($nama_merek);
    }
    public function getUnitMerekAttribute($unit_merek)
    {
        return ucwords($unit_merek);
    }
    public function setNamaMerekAttribute($nama_merek)
    {
        return $this->attributes['nama_merek'] = strtolower($nama_merek);
    }
}

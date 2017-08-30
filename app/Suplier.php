<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SoTransaksiBarang;
use App\PoTransaksi;

class Suplier extends Model
{
    protected $guarded = [];
    
    public function SoTransaksiBarang()
    {
        $this->hasMany('Suplier');
    }
    public function PoTransaksi()
    {
        $this->hasMany('Suplier');
    }
}
<?php

namespace App;

use App\Merek;
use App\Satuan;
use App\PoTransaksi;
use App\MaTransaksiDetail;
use App\SoTransaksiBarang;

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
    public function SoTransaksiBarang()
    {
        return $this->hasMany('SoTransaksiBarang');
    }
    public function MaTransaksiDetail()
    {
        return $this->hasMany('MaTransaksiDetail');
    }
    public function PoTransaksi()
    {
        return $this->hasMany('PoTransaksi');
    }
}

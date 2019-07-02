<?php

namespace App;

use App\SoPelanggan;
use App\SoTransaksi;
use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    protected $guarded = [];
    
    public function SoPelanggan()
    {
        return $this->hasMany('SoPelanggan');
    }
	public function SoTransaksi()
    {
        return $this->hasMany('SoTransaksi');
    }
}

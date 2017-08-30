<?php

namespace App;

use App\SoTransaksi;
use App\Asuransi;
use App\SoKendaraan;

use Illuminate\Database\Eloquent\Model;

class SoPelanggan extends Model
{
    protected $primaryKey = 'so_transaksi_id';
    protected $guarded = [];
    
    public function SoTransaksi()
    {
        return $this->belongsTo('App\SoTransaksi', 'so_transaksi_id');
    }
    public function Asuransi()
    {
        return $this->belongsTo(Asuransi::class);
    }
    public function SoKendaraan()
    {
        return $this->hasMany('SoKendaraan');
    }
}

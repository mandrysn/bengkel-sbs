<?php

namespace App;

use App\Merek;
use App\SoTransaksi;
use App\SoPelanggan;

use Illuminate\Database\Eloquent\Model;

class SoKendaraan extends Model
{
    protected $primaryKey = 'so_transaksi_id';
    protected $guarded = [];
    
    public function SoPelanggan()
    {
        return $this->belongsTo(SoPelanggan::class);
    }
    public function SoTransaksi()
    {
        return $this->belongsTo('App\SoTransaksi', 'so_transaksi_id');
    }
    public function Merek()
    {
        return $this->belongsTo(Merek::class);
    }
    
}

<?php

namespace App;

use App\PemesananBarang;
use App\SoTransaksi;

use Illuminate\Database\Eloquent\Model;

class PemesananBarang extends Model
{
    protected $table = 'po_transaksis';
    protected $guarded = [];

    public function SoTransaksi()
    {
        return $this->hasOne('App\SoTransaksi');
    }
    // public function SoPelanggan()
    // {
    //     return $this->hasOne('App\SoPelanggan', 'transaksi_id');
    // }
    // public function SoKendaraan()
    // {
    //     return $this->hasOne('App\SoKendaraan', 'transaksi_id');
    // }
}

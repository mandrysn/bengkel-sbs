<?php

namespace App;

use App\SoKendaraan;
use App\SoPelanggan;
use App\BarangMasuk;
use App\PoTransaksi;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;

use Illuminate\Database\Eloquent\Model;

class SoTransaksi extends Model
{
    protected $guarded = [];
    
    public function SoPelanggan()
    {
        return $this->hasOne('App\SoPelanggan', 'so_transaksi_id');
    }
    public function SoKendaraan()
    {
        return $this->hasOne('App\SoKendaraan', 'so_transaksi_id');
    }
    public function SoTransaksiBarang()
    {
        return $this->hasMany('SoTransaksiBarang');
    }
    public function SoTransaksiJasa()
    {
        return $this->hasMany('SoTransaksiJasa');
    }
    public function BarangMasuk()
    {
        return $this->hasOne('BarangMasuk');
    }
    public function PoTransaksi()
    {
        return $this->belongsTo('App\PoTransaksi', 'so_transaksi_id');
    }
    public function getTanggalMasukAttribute($tanggal_masuk)
    {
        return \Carbon\Carbon::parse($tanggal_masuk)
            ->format('d, M Y');
    }

}

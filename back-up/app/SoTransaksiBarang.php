<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\BarangMasukDetail;
use App\PoTransaksiBarang;
use App\SoTransaksi;
use App\Barang;
use App\Suplier;

class SoTransaksiBarang extends Model
{
    protected $guarded = [];
    
    public function SoTransaksi()
    {
        return $this->belongsTo(SoTransaksi::class);
    }
    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function Suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function PoTransaksiBarang()
    {
        return $this->hasOne('PoTransaksiBarang', 'so_transaksi_barang_id');
    }
    public function BarangMasukDetail()
    {
        return $this->hasOne('BarangMasukDetail', 'so_transaksi_barang_id');
    }
}

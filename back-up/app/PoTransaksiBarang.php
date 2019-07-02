<?php

namespace App;

use App\Barang;
use App\BarangMasukDetail;
use App\PoTransaksi;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;
use Illuminate\Database\Eloquent\Model;

class PoTransaksiBarang extends Model
{
    protected $guarded = [];

    public function PoTransaksi()
    {
        return $this->belongsTo(PoTransaksi::class);
    }
    public function SoTransaksiBarang()
    {
        return $this->belongsTo(SoTransaksiBarang::class);
    }
    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function BarangMasukDetail()
    {
        return $this->hasOne('BarangMasukDetail', 'po_transaksi_barang_id');
    }
}

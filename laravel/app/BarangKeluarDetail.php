<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    protected $guarded = [];

    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function Suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function BarangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class);
    }
}

<?php

namespace App;

use App\Suplier;
use App\SoTransaksi;
use Illuminate\Database\Eloquent\Model;

class PoTransaksi extends Model
{
    protected $guarded = [];

    public function SoTransaksi()
    {
        return $this->hasOne('App\SoTransaksi', 'id');
    }
    public function Suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function getTanggalMasukAttribute($tanggal_masuk)
    {
        \Carbon\Carbon::setLocale('id');
        return \Carbon\Carbon::parse($tanggal_masuk)
            ->format('d-F-Y');
    }
}

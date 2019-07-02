<?php

namespace App;
use App\BuktiKeluarDetail;
use Illuminate\Database\Eloquent\Model;

class BuktiKeluar extends Model
{
    protected $guarded = [];

    public function BuktiKeluarDetail()
    {
        return $this->hasMany('BuktiKeluarDetail');
    }
    public function getTanggalMasukAttribute($tanggal_masuk)
    {
        \Carbon\Carbon::setLocale('id');
        return \Carbon\Carbon::parse($tanggal_masuk)
            ->format('d-F-Y');
    }
}

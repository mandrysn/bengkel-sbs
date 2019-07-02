<?php

namespace App;

use App\Material;
use Illuminate\Database\Eloquent\Model;

class BuktiMaterial extends Model
{
    protected $guarded = [];

    public function Material()
    {
        return $this->belongsTo(Material::class);
    }
    public function getTanggalMasukAttribute($tanggal_masuk)
    {
        \Carbon\Carbon::setLocale('id');
        return \Carbon\Carbon::parse($tanggal_masuk)
            ->format('d-F-Y');
    }
}

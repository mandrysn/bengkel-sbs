<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SoTransaksi;

class SoTransaksiJasa extends Model
{
    protected $guarded = [];
    
    public function SoTransaksi()
    {
        return $this->belongsTo(SoTransaksi::class);
    }
}

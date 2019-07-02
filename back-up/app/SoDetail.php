<?php

namespace App;

use App\SoTransaksi;
use Illuminate\Database\Eloquent\Model;

class SoDetail extends Model
{
    protected $guarded = [];

    public function SoTransaksi()
    {
        return $this->belongsTo(SoTransaksi::class);
    }
}

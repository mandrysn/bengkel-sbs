<?php

namespace App;

use App\Asuransi;
use App\SoKendaraan;

use Illuminate\Database\Eloquent\Model;

class SoPelanggan extends Model
{
    protected $guarded = [];
    
    public function Asuransi()
    {
        return $this->belongsTo(Asuransi::class);
    }
    public function SoKendaraan()
    {
        return $this->hasMany('SoKendaraan');
    }
}

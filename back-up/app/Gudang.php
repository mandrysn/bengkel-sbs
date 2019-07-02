<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang;
use App\Suplier;

class Gudang extends Model
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
}

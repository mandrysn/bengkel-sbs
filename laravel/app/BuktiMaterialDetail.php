<?php

namespace App;

use App\Barang;
use App\Suplier;
use Illuminate\Database\Eloquent\Model;

class BuktiMaterialDetail extends Model
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

<?php

namespace App;

use App\Barang;
use Illuminate\Database\Eloquent\Model;

class MaterialBarang extends Model
{
    protected $guarded = [];

    public function Barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PengeluaranSuplier;
use App\Suplier;

class Utang extends Model
{
    protected $guarded = [];

    public function Suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function PengeluaranSuplier()
    {
        return $this->hasMany('PengeluaranSuplier');
    }
}
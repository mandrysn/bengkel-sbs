<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Suplier;
use App\Utang;

class PengeluaranSuplier extends Model
{
    protected $guarded = [];

    public function Utang()
    {
        return $this->belongsTo(Utang::class);
    }
}

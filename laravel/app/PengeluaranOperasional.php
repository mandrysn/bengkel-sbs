<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Operasional;
use App\Pengeluaran;

class PengeluaranOperasional extends Model
{
    protected $guarded = [];

    public function Operasional()
    {
        return $this->belongsTo(Operasional::class);
    }
    public function Pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class);
    }
}

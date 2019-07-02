<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PengeluaranOperasional;
use App\Pengeluaran;

class Operasional extends Model
{
    protected $guarded = [];

    public function Operasional()
    {
        return $this->hasMany('Operasional');
    }
	public function Pengeluaran()
    {
        return $this->hasMany('Pengeluaran');
    }
    public function getNamaOperasionalAttribute($nama_operasional)
    {
        return ucwords($nama_operasional);
    }
}

<?php

namespace App;

use App\Barang;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $guarded = [];
    
    public function Barang()
    {
        return $this->hasMany('Barang');
    }
    public function ServisOrder()
    {
        return $this->hasMany('Barang');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoKendaraanAfter extends Model
{
    protected $primaryKey = 'so_transaksi_id';
    protected $guarded = [];
    
    public function SoTransaksi()
    {
        return $this->belongsTo('App\SoTransaksi', 'so_transaksi_id');
    }
}

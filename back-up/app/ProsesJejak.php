<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsesJejak extends Model
{
    protected $fillable   = ['so_transaksi_id', 'foto_proses'];
    protected $guarded = [];

    public function SoTransaksi()
    {
        return $this->belongsTo('App\SoTransaksi', 'id');
    }
    public function getFacingsAttribute()
    {
        return explode('|', $this->facings);
    }
}

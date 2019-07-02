<?php

namespace App;

use App\Suplier;
use App\Barang;
use App\BuktiKeluar;
use Illuminate\Database\Eloquent\Model;

class BuktiKeluarDetail extends Model
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
    public function BuktiKeluar()
    {
        return $this->belongsTo(BuktiKeluar::class);
    }
}

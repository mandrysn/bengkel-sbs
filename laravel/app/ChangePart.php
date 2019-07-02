<?php

namespace App;

use App\SoTransaksi;
use App\ChangePart;
use Illuminate\Database\Eloquent\Model;

class ChangePart extends Model
{
    protected $guarded = [];

    public static $bongkarPasang = '1';
    public static $lasKetok = '2';
    public static $dempul = '3';
    public static $poles = '4';

    public function getJenisLayananAttribute()
    {
        $label = [
            ChangePart::$bongkarPasang => 'Bongkar Pasang',
            ChangePart::$lasKetok => 'Las Ketok',
            ChangePart::$dempul => 'Dempul',
            ChangePart::$poles => 'Poles'
        ];
        return $label[$this->layanan];
    }

    public function SoTransaksi()
    {
        return $this->belongsTo(SoTransaksi::class);
    }
}

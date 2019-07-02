<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PoTransaksi;
use App\SoTransaksi;
use App\Barang;
use App\BarangMasukDetail;

class BarangMasuk extends Model
{
    protected $guarded = [];

    public function PoTransaksi()
    {
        return $this->belongsTo(PoTransaksi::class);
    }
    public function SoTransaksi()
    {
        return $this->belongsTo(SoTransaksi::class);
    }
    public function BarangMasukDetail()
    {
        return $this->hasMany('BarangMasukDetail');
    }
    public function getTanggalMasukAttribute($tanggal_masuk)
    {
        \Carbon\Carbon::setLocale('id');
        switch(\Carbon\Carbon::parse($tanggal_masuk)->format('F')) {
            case 'January' :
                $bulan = 'Januari';
                break;
            case 'February' :
                $bulan = 'Februari';
                break;
            case 'March' :
                $bulan = 'Maret';
                break;
            case 'April' :
                $bulan = 'April';
                break;
            case 'May' :
                $bulan = 'Mei';
                break;
            case 'June' :
                $bulan = 'Juni';
                break;
            case 'July' :
                $bulan = 'Juli';
                break;
            case 'August' :
                $bulan = 'Agustus';
                break;
            case 'September' :
                $bulan = 'September';
                break;
            case 'October' :
                $bulan = 'October';
                break;
            case 'November' :
                $bulan = 'November';
                break;
            default:
                $bulan = 'December';
        }

        return \Carbon\Carbon::parse($tanggal_masuk)
            ->format('d-') . $bulan . \Carbon\Carbon::parse($tanggal_masuk)
            ->format('-Y');
    }
}

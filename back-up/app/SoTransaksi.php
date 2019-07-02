<?php

namespace App;

use App\SoKendaraan;
use App\SoPelanggan;
use App\BarangMasuk;
use App\PoTransaksi;
use App\TagihanOr;
use App\SoDetail;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;
use App\ChangePart;
use Illuminate\Database\Eloquent\Model;

class SoTransaksi extends Model
{
    protected $guarded = [];
    
    public function SoKendaraan()
    {
        return $this->belongsTo(SoKendaraan::class);
    }
    public function SoKendaraanAfter()
    {
        return $this->hasOne('App\SoKendaraanAfter', 'so_transaksi_id');
    }
    public function ProsesJejak()
    {
        return $this->hasMany('App\ProsesJejak', 'so_transaksi_id');
    }
    public function SoDetail()
    {
        return $this->hasMany('SoDetail');
    }
    public function ChangePart()
    {
        return $this->hasMany('ChangePart');
    }
    public function SoTransaksiBarang()
    {
        return $this->hasMany('SoTransaksiBarang');
    }
    public function SoTransaksiJasa()
    {
        return $this->hasMany('SoTransaksiJasa');
    }
    public function BarangMasuk()
    {
        return $this->hasOne('BarangMasuk');
    }
    public function Tagihan()
    {
        return $this->hasOne('Tagihan');
    }
    public function BarangKeluar()
    {
        return $this->hasOne('BarangKeluar');
    }
    public function getTanggalInvoiceAttribute($tanggal_invoice)
    {
        \Carbon\Carbon::setLocale('id');

        switch(\Carbon\Carbon::parse($tanggal_invoice)->format('l')) {
            case 'Monday' :
                $hari = 'Senin';
                break;
            case 'Tuesday' :
                $hari = 'Selasa';
                break;
            case 'Wednesday' :
                $hari = 'Rabu';
                break;
            case 'Thursday' :
                $hari = 'Kamis';
                break;
            case 'Friday' :
                $hari = 'Jumat';
                break;
            case 'Saturday' :
                $hari = 'Sabtu';
                break;
            default:
                $hari = 'Minggu';
        }

        switch(\Carbon\Carbon::parse($tanggal_invoice)->format('F')) {
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

        return $hari . ', ' . \Carbon\Carbon::parse($tanggal_invoice)
            ->format('d-') . $bulan . \Carbon\Carbon::parse($tanggal_invoice)
            ->format('-Y');
    }
    public function getTanggalSoAttribute($tanggal_so)
    {
        \Carbon\Carbon::setLocale('id');
        
        switch(\Carbon\Carbon::parse($tanggal_so)->format('l')) {
            case 'Monday' :
                $hari = 'Senin';
                break;
            case 'Tuesday' :
                $hari = 'Selasa';
                break;
            case 'Wednesday' :
                $hari = 'Rabu';
                break;
            case 'Thursday' :
                $hari = 'Kamis';
                break;
            case 'Friday' :
                $hari = 'Jumat';
                break;
            case 'Saturday' :
                $hari = 'Sabtu';
                break;
            default:
                $hari = 'Minggu';
        }

        switch(\Carbon\Carbon::parse($tanggal_so)->format('F')) {
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

        return $hari . ', ' . \Carbon\Carbon::parse($tanggal_so)
            ->format('d-') . $bulan . \Carbon\Carbon::parse($tanggal_so)
            ->format('-Y');
    }
    public function getTanggalPreAttribute($tanggal_pre)
    {
        \Carbon\Carbon::setLocale('id');
        switch(\Carbon\Carbon::parse($tanggal_pre)->format('F')) {
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

        return \Carbon\Carbon::parse($tanggal_pre)
            ->format('d-') . $bulan . \Carbon\Carbon::parse($tanggal_pre)
            ->format('-Y');
    }
	public function getTanggalClaimAttribute($tanggal_claim)
    {
        \Carbon\Carbon::setLocale('id');

        switch(\Carbon\Carbon::parse($tanggal_claim)->format('l')) {
            case 'Monday' :
                $hari = 'Senin';
                break;
            case 'Tuesday' :
                $hari = 'Selasa';
                break;
            case 'Wednesday' :
                $hari = 'Rabu';
                break;
            case 'Thursday' :
                $hari = 'Kamis';
                break;
            case 'Friday' :
                $hari = 'Jumat';
                break;
            case 'Saturday' :
                $hari = 'Sabtu';
                break;
            default:
                $hari = 'Minggu';
        }

        switch(\Carbon\Carbon::parse($tanggal_claim)->format('F')) {
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

        return $hari . ', ' . \Carbon\Carbon::parse($tanggal_claim)
            ->format('d-') . $bulan . \Carbon\Carbon::parse($tanggal_claim)
            ->format('-Y');
    }
}

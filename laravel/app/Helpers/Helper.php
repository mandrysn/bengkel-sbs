<?php

namespace App\Helpers;

use App\SoTransaksi;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function countNotifikasi()
    {
        return SoTransaksi::where('status', 1)->orderBy('tanggal_pre','desc')->count();
    }
}

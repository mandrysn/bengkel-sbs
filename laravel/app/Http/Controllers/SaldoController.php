<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Permission;
use App\Pemasukan;
use App\Pengeluaran;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modul_id = 1;
        if (Auth::user()->id != '1') {
            $cek = Permission::where('modul_id', $modul_id)
                    ->where('group_id', Auth::user()->group_id)->first();
            if ( $cek != "" ) {
                if ( $modul_id != $cek->modul_id) {
                    return "<script language='javascript'>
                            alert('Anda Tidak Memiliki Akses');
                            document.location='".asset('/')."';
                            </script>";
                }
            } else {
                return "<script language='javascript'>
                        alert('Anda Tidak Memiliki Akses');
                        document.location='".asset('/')."';
                        </script>";
            }
        }

        $title = 'Saldo';

        $pemasukans = Pemasukan::get();
        $tagihan_pemasukan = 0;
        $total_pemasukan = 0;
            foreach($pemasukans as $pemasukan) {
                $tagihan_pemasukan = $pemasukan->jumlah_bayar;
                $total_pemasukan += $tagihan_pemasukan;
            }
            $a = $total_pemasukan;


        $pengeluarans = Pengeluaran::get();
        $tagihan_pengeluaran = 0;
        $total_pengeluaran = 0;
            foreach($pengeluarans as $pengeluaran) {
                $tagihan_pengeluaran = $pengeluaran->total_pengeluaran;
                $total_pengeluaran += $tagihan_pengeluaran;
            }
            $b = $total_pengeluaran;
        
        return view('keuangan.saldo.index', compact('title', 'a', 'b'));
    }
}

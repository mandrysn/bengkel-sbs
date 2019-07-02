<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\Tagihan;
use Session;
use Auth;
use PDF;

class RekapPreSoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;
        $now = date('Y-m-d');

        if ($request->route == 'pre-so') {
            
            if ( empty($awal) && empty($akhir) ) {
                $sot = SoTransaksi::where('status', 1)->orderby('tanggal_pre', 'asc')->get();
            } else if ( empty($akhir) ) {
                $sot = SoTransaksi::where('status', 1)->whereBetween('tanggal_pre', [$awal, $now])->orderby('tanggal_pre', 'asc')->get();
            } else {
                $sot = SoTransaksi::where('status', 1)->whereBetween('tanggal_pre', [$awal, $akhir])->orderby('tanggal_pre', 'asc')->get();
            }
            
            $pdf = PDF::loadview('pre-so.rekap', compact('sot'));
            return $pdf->setPaper('f4')->download('Pre-SO.pdf');

        } else if ($request->route == 'jejak') {

            if ( empty($awal) && empty($akhir) && empty($request->status_tagihan) && empty($request->status_pekerjaan) ) {

                $sot = Tagihan::orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_tagihan) && empty($request->status_pekerjaan) ) {

                $sot = Tagihan::whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_tagihan) ) {

                $sot = Tagihan::where('status_pekerjaan', $request->status_pekerjaan)
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_pekerjaan) ) {

                $sot = Tagihan::where('status_tagihan', $request->status_tagihan)
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_tagihan) && empty($request->status_pekerjaan) ) {

                $sot = Tagihan::whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_tagihan) ) {
                $sot = Tagihan::where('status_pekerjaan', $request->status_pekerjaan)
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();
            } else if ( empty($request->status_pekerjaan) ) {
                $sot = Tagihan::where('status_tagihan', $request->status_tagihan)
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();
            } else {
                $sot = Tagihan::whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();
            }

            $pdf = PDF::loadview('jejak-pelanggan.rekap', compact('sot'));
            return $pdf->setPaper('f4')->download('Jejak-Pelanggan.pdf');

        } else if ( $request->route == 'pre-invoice' ) {

            if ( empty($awal) && empty($akhir) ) {

                $sot = SoTransaksi::where('status', 2)
                                  ->where('no_transaksi', 'LIKE', '%-SO%')
                                  ->whereNotNull('tanggal_invoice')
                                  ->orderby('tanggal_invoice', 'asc')
                                  ->get();

            } else if ( empty($akhir) ) {

                $sot = SoTransaksi::where('status', 2)
                                  ->where('no_transaksi', 'LIKE', '%-SO%')
                                  ->whereNotNull('tanggal_invoice')
                                  ->whereBetween('tanggal_invoice', [$awal, $now])
                                  ->orderby('tanggal_invoice', 'asc')
                                  ->get();

            } else {

                $sot = SoTransaksi::where('status', 2)
                                  ->where('no_transaksi', 'LIKE', '%-SO%')
                                  ->whereNotNull('tanggal_invoice')
                                  ->whereBetween('tanggal_invoice', [$awal, $akhir])
                                  ->orderby('tanggal_invoice', 'asc')
                                  ->get();
                                  
            }
            
            $pdf = PDF::loadview('ekstimasi.rekap', compact('sot'));
            return $pdf->setPaper('f4')->download('Pre-Invoice.pdf');
        }
    }
}

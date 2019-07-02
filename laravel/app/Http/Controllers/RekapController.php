<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\Tagihan;
use App\Pemasukan;
use App\Pengeluaran;
use App\Material;
use App\PoTransaksi;
use App\BarangMasuk;
use App\BuktiMaterial;
use App\BarangKeluar;
use App\BuktiKeluar;
use Session;
use Auth;
use PDF;

class RekapController extends Controller
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
		$r = $request->asuransi;
        $now = date('Y-m-d');

        if ($request->route == 'pre-so') {
            
            if ( empty($awal) && empty($akhir) ) {
				
                $sot = SoTransaksi::where('status', 1)
								  ->orderby('tanggal_pre', 'asc')
								  ->get();
				
            } else if ( empty($akhir) ) {
				
                $sot = SoTransaksi::where('status', 1)
								  ->whereBetween('tanggal_pre', [$awal, $now])
								  ->orderby('tanggal_pre', 'asc')
								  ->get();
				
            } else {
				
                $sot = SoTransaksi::where('status', 1)
								  ->whereBetween('tanggal_pre', [$awal, $akhir])
								  ->orderby('tanggal_pre', 'asc')
								  ->get();
            }
            
            $pdf = PDF::loadview('pre-so.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Unit-Lapor-' . $now . '.pdf');

        } else if ($request->route == 'so') {
            // In Progress = 1...SPK = 2
            if ( $request->status_data == '1' ) {

                $sot = SoTransaksi::where('status', 2)
                                  ->whereNotExists(function($query) {
                                        $query->selectRaw('tagihans.so_transaksi_id')
                                              ->from('tagihans')
                                              ->whereRaw('so_transaksis.id = tagihans.so_transaksi_id'); })
                                  ->orderby('tanggal_so', 'asc')
                                  ->get();

            } else if ( empty($awal) && empty($akhir) && $request->status_data == '2' ) {

                $sot = SoTransaksi::where('status', 2)
                                  ->orderby('tanggal_so', 'asc')
                                  ->get();

            } else if ( empty($akhir) && $request->status_data == '2' ) {

                $sot = SoTransaksi::where('status', 2)
                                  ->whereBetween('tanggal_so', [$awal, $now])
                                  ->orderby('tanggal_so', 'asc')
                                  ->get();

            } else if ( $request->status_data == '2' ) {

                $sot = SoTransaksi::where('status', 2)
                                  ->whereBetween('tanggal_so', [$awal, $akhir])
                                  ->orderby('tanggal_so', 'asc')
                                  ->get();

            }
            
            $title = $request->status_data == '1' ? 'Unit in Progress' : 'Surat Perintah Kerja';

            $pdf = PDF::loadview('servis-order.rekap', compact('sot', 'title'));
            return $pdf->setPaper('a4')->download('SPK-'. $title . '-' . $now . '.pdf');

        } else if ($request->route == 'jejak') {

            if ( empty($awal) && empty($akhir) && empty($request->status_tagihan) && empty($request->status_pekerjaan) && empty($request->asuransi) ) {
                $sot = Tagihan::orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($awal) && empty($akhir) && empty($request->status_tagihan) && empty($request->asuransi) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_tagihan) && empty($request->status_pekerjaan) && empty($request->asuransi) ) {
                $sot = Tagihan::whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_tagihan) && empty($request->status_pekerjaan) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_tagihan) && empty($request->asuransi) ) {
                $sot = Tagihan::where('status_pekerjaan', $request->status_pekerjaan)
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_tagihan) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->where('status_pekerjaan', $request->status_pekerjaan)
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_pekerjaan) && empty($request->asuransi) ) {
                $sot = Tagihan::where('status_tagihan', $request->status_tagihan)
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->status_pekerjaan) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->where('status_tagihan', $request->status_tagihan)
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_tagihan) && empty($request->status_pekerjaan) && empty($request->asuransi) ) {
                $sot = Tagihan::whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_tagihan) && empty($request->status_pekerjaan) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_tagihan) && empty($request->asuransi) ) {
                $sot = Tagihan::where('status_pekerjaan', $request->status_pekerjaan)
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_tagihan) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->where('status_pekerjaan', $request->status_pekerjaan)
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_pekerjaan) && empty($request->asuransi) ) {
                $sot = Tagihan::where('status_tagihan', $request->status_tagihan)
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->status_pekerjaan) ) {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->where('status_tagihan', $request->status_tagihan)
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();
                              
            } else if ( empty($request->asuransi) ) {
                $sot = Tagihan::whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();
                              
            } else {
                $sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
                                $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
                              ->where('so_transaksis.asuransi_id', '=', $r)
                              ->where('deleted', 'N')
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            }

            $pdf = PDF::loadview('jejak-pelanggan.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Jejak-Pelanggan-' . $now . '.pdf');

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
            return $pdf->setPaper('a4', 'landscape')->download('Pre-Invoice-' . $now . '.pdf');
        
        } else if ($request->route == 'tagihan-or') {

            if ( empty($awal) && empty($akhir) ) {

                $sot = Tagihan::where('deleted', 'N')->whereNotNull('jumlah_or')
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) ) {

                $sot = Tagihan::where('deleted', 'N')->whereNotNull('jumlah_or')
                              ->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else {

                $sot = Tagihan::where('deleted', 'N')->whereNotNull('jumlah_or')
                              ->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            }

            $pdf = PDF::loadview('tagihan-or.rekap', compact('sot'));
            return $pdf->setPaper('a4', 'landscape')->download('Tagihan-OR-' . $now . '.pdf');

        } else if ($request->route == 'invoice') {
            
            if ( empty($awal) && empty($akhir) && empty($request->asuransi) ) {

                $sot = Tagihan::where('deleted', 'N')->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) && empty($request->asuransi) ) {

                $sot = Tagihan::where('deleted', 'N')->whereBetween('tanggal_masuk', [$awal, $now])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($request->asuransi) ) {

                $sot = Tagihan::where('deleted', 'N')->whereBetween('tanggal_masuk', [$awal, $akhir])
                              ->orderby('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($awal) && empty($akhir) ) {
				
				$sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
								$join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
								->where('so_transaksis.asuransi_id', '=', $r)
								->where('deleted', 'N')
							  ->orderby('tanggal_masuk', 'asc')
                              ->get();

			} else if ( empty($akhir) ) {
				
				$sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
								$join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
								->where('so_transaksis.asuransi_id', '=', $r)
								->where('deleted', 'N')
								->whereBetween('tanggal_masuk', [$awal, $now])
							  ->orderby('tanggal_masuk', 'asc')
                              ->get();
			} else {
				$sot = Tagihan::join('so_transaksis', function ($join) use ($r) {
								$join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id'); })
								->where('so_transaksis.asuransi_id', '=', $r)
								->where('deleted', 'N')
								->whereBetween('tanggal_masuk', [$awal, $akhir])
							  ->orderby('tanggal_masuk', 'asc')
                              ->get();
            }
            
            $pdf = PDF::loadview('tagihan.rekap', compact('sot'));
            return $pdf->setPaper('a4', 'landscape')->download('Invoice-' . $now . '.pdf');

        } else if ($request->route == 'pemasukan') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = Pemasukan::orderBy('tanggal_masuk', 'asc')
                                ->get();

            } else if ( empty($akhir) ) {

                $sot = Pemasukan::whereBetween('tanggal_masuk', [$awal, $now])
                                ->orderby('tanggal_masuk', 'asc')
                                ->get();

            } else {
                $sot = Pemasukan::whereBetween('tanggal_masuk', [$awal, $akhir])
                                ->orderby('tanggal_masuk', 'asc')
                                ->get();
            }
            
            $pdf = PDF::loadview('keuangan.pemasukan.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Pemasukan-' . $now . '.pdf');

        } else if ($request->route == 'pengeluaran') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = Pengeluaran::orderBy('tanggal_masuk', 'asc')
                                ->get();

            } else if ( empty($akhir) ) {

                $sot = Pengeluaran::whereBetween('tanggal_masuk', [$awal, $now])
                                ->orderby('tanggal_masuk', 'asc')
                                ->get();

            } else {
                $sot = Pengeluaran::whereBetween('tanggal_masuk', [$awal, $akhir])
                                ->orderby('tanggal_masuk', 'asc')
                                ->get();
            }
            
            $pdf = PDF::loadview('keuangan.pengeluaran.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Pengeluaran-' . $now . '.pdf');

        } else if ($request->route == 'order-barang') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/SO%')
                                  ->orderBy('tanggal_masuk', 'asc')
                                  ->get();

            } else if ( empty($akhir) ) {

                $sot = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/SO%')
                                  ->whereBetween('tanggal_masuk', [$awal, $now])
                                  ->orderby('tanggal_masuk', 'asc')
                                  ->get();

            } else {

                $sot = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/SO%')
                                  ->whereBetween('tanggal_masuk', [$awal, $akhir])
                                  ->orderby('tanggal_masuk', 'asc')
                                  ->get();

            }
            
            $pdf = PDF::loadview('order-barang.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Purchase-Order-' . $now . '.pdf');

        } else if ($request->route == 'order-material') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = Material::where('ma_transaksi', 'LIKE', '%-PO/MA%')
                              ->orderBy('tanggal_masuk', 'asc')
                              ->get();

            } else if ( empty($akhir) ) {

                $sot = Material::where('ma_transaksi', 'LIKE', '%-PO/MA%')
                               ->whereBetween('tanggal_masuk', [$awal, $now])
                               ->orderby('tanggal_masuk', 'asc')
                               ->get();

            } else {

                $sot = Material::where('ma_transaksi', 'LIKE', '%-PO/MA%')
                               ->whereBetween('tanggal_masuk', [$awal, $akhir])
                               ->orderby('tanggal_masuk', 'asc')
                               ->get();
            }
            
            $pdf = PDF::loadview('order-material.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Pengajuan-Pembayaran-' . $now . '.pdf');

        } else if ($request->route == 'barang-masuk') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = BarangMasuk::orderBy('tanggal_masuk', 'asc')
                                  ->get();

            } else if ( empty($akhir) ) {

                $sot = BarangMasuk::whereBetween('tanggal_masuk', [$awal, $now])
                                  ->orderby('tanggal_masuk', 'asc')
                                  ->get();

            } else {
                $sot = BarangMasuk::whereBetween('tanggal_masuk', [$awal, $akhir])
                                  ->orderby('tanggal_masuk', 'asc')
                                  ->get();
            }
            
            $pdf = PDF::loadview('barang-masuk.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Bukti-Barang-Masuk-' . $now . '.pdf');

        } else if ($request->route == 'bukti-material') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = BuktiMaterial::orderBy('tanggal_masuk', 'asc')
                                  ->get();

            } else if ( empty($akhir) ) {

                $sot = BuktiMaterial::whereBetween('tanggal_masuk', [$awal, $now])
                                  ->orderby('tanggal_masuk', 'asc')
                                  ->get();

            } else {
                $sot = BuktiMaterial::whereBetween('tanggal_masuk', [$awal, $akhir])
                                  ->orderby('tanggal_masuk', 'asc')
                                  ->get();
            }
            
            $pdf = PDF::loadview('bukti-material.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Bukti-Barang-Material-' . $now . '.pdf');

        } else if ($request->route == 'barang-keluar') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = BarangKeluar::orderBy('tanggal_masuk', 'asc')
                                   ->get();

            } else if ( empty($akhir) ) {

                $sot = BarangKeluar::whereBetween('tanggal_masuk', [$awal, $now])
                                   ->orderby('tanggal_masuk', 'asc')
                                   ->get();

            } else {
                $sot = BarangKeluar::whereBetween('tanggal_masuk', [$awal, $akhir])
                                   ->orderby('tanggal_masuk', 'asc')
                                   ->get();
            }
            
            $pdf = PDF::loadview('barang-keluar.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Bukti-Barang-Keluar-' . $now . '.pdf');

        } else if ($request->route == 'bukti-keluar') {
            
            if ( empty($awal) && empty($akhir) ) {

                $sot = BuktiKeluar::orderBy('tanggal_masuk', 'asc')
                                   ->get();

            } else if ( empty($akhir) ) {

                $sot = BuktiKeluar::whereBetween('tanggal_masuk', [$awal, $now])
                                   ->orderby('tanggal_masuk', 'asc')
                                   ->get();

            } else {
                $sot = BuktiKeluar::whereBetween('tanggal_masuk', [$awal, $akhir])
                                   ->orderby('tanggal_masuk', 'asc')
                                   ->get();
            }
            
            $pdf = PDF::loadview('bukti-keluar.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Bukti-Barang-Keluar-Pribadi-' . $now . '.pdf');

        } // end if
    }
}

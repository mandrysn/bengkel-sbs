<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\SoTransaksiBarang;
use App\SoTransaksiJasa;
use App\ChangePart;
use App\SoDetail;
use App\Tagihan;
use App\Pemasukan;
use App\Pengeluaran;
use App\PoTransaksi;
use App\PoTransaksiBarang;
use App\Material;
use App\MaterialBarang;
use App\BarangMasuk;
use App\BarangMasukDetail;
use App\BuktiMaterial;
use App\BuktiMaterialDetail;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use App\BuktiKeluar;
use App\BuktiKeluarDetail;
use App\Utang;
use App\Operasional;
use App\PengeluaranOperasional;
use App\PengeluaranSuplier;

use Session;
use Auth;
use PDF;

class PrintController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$id = $request->id;
		
        if ($request->route == 'pre-so') {
            
			$transaksi = SoTransaksi::findOrFail($id);
			$details = SoDetail::where('status', '0')->where('so_transaksi_id', $id)->get();
			$title     = 'Unit Lapor No. ' . $transaksi->no_transaksi;
			
			$pdf = PDF::loadview('pre-so.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('Unit-Lapor-'.$transaksi->no_transaksi.'.pdf');

        } else if ($request->route == 'so') {
            
		    $transaksi = SoTransaksi::findOrFail($id);
			$details   = SoDetail::where('status', '1')->where('so_transaksi_id', $id)->get();
			$gantis   = ChangePart::where('so_transaksi_id', $id)->get();
			$title     = 'Surat Perintah Kerja No. ' . $transaksi->no_transaksi;
			
			$pdf = PDF::loadview('servis-order.print', compact('transaksi', 'details', 'gantis', 'title'));
			return $pdf->setPaper('f4')->download('SPK-'.$transaksi->no_transaksi.'.pdf');
			
        } else if ( $request->route == 'pre-invoice' ) {

			$sot   = SoTransaksi::findOrFail($id);
			$details = SoDetail::where('so_transaksi_id', $id)->get();

			$detail_barang   = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '2')->get();
			$detail_material = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '1')->get();
			$detail_jasa     = SoTransaksiJasa::where('so_transaksi_id', $id)->get();
			$count_jasa    = SoTransaksiJasa::where('so_transaksi_id', $id)->count();
			$count_barang  = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '2')->count();
			$count_material  = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '1')->count();
			
			$title     = 'Pre Invoice No. ' . $sot->no_transaksi;
			
			$pdf = PDF::loadview('ekstimasi.print', compact('title', 'sot', 'details', 'detail_barang', 'detail_jasa', 'detail_material', 'count_material', 'count_jasa', 'count_barang'));
			// return view('pre-so.print');
			return $pdf->setPaper('a4')->download('Pre-Invoice-'.$sot->no_transaksi.'.pdf');
		
        } else if ($request->route == 'tagihan-or') {
			
			$data       = Tagihan::findOrFail($id);
			$title = 'Tagihan-or-'.$data->kode_tagihan;
		    $pdf = PDF::loadview('tagihan-or.print', compact('data'));
		    return $pdf->setPaper('a4')->download('Tagihan-or-'.$data->kode_tagihan.'.pdf');

        } else if ($request->route == 'invoice') {
            
			$data       = Tagihan::findOrFail($id);

			$detail_barang = SoTransaksiBarang::where('so_transaksi_id', $data->so_transaksi_id)->where('kategori_transaksi', 2)->get();
			$tagihan_barang = 0;
			$total_barang = 0;
			foreach($detail_barang as $datab) {
				$tagihan_barang = ( $datab->harga_transaksi - ($datab->harga_transaksi * $datab->diskon / 100) ) * $datab->quantity;
				$total_barang += $tagihan_barang;
			}
			$totalb = $total_barang;

			$detail_jasa = SoTransaksiJasa::where('so_transaksi_id', $data->so_transaksi_id)->get();
			$tagihan_jasa = 0;
			$total_jasa = 0;
			foreach($detail_jasa as $dataj) {
				$tagihan_jasa = ( $dataj->harga_transaksi - ($dataj->harga_transaksi * $dataj->diskon / 100) ) * $dataj->quantity;
				$total_jasa += $tagihan_jasa;
			}
			$totalj = $total_jasa;

			$detail_material = SoTransaksiBarang::where('so_transaksi_id', $data->so_transaksi_id)->where('kategori_transaksi', 1)->get();
			$tagihan_material = 0;
			$total_material = 0;
			foreach($detail_material as $datam) {
				$tagihan_material = ( $datam->harga_transaksi - ($datam->harga_transaksi * $datam->diskon / 100) ) * $datam->quantity;
				$total_material += $tagihan_material;
			}
			$totalm = $total_material;        

			
			$pdf = PDF::loadview('tagihan.print', compact('data', 'button', 'totalb', 'totalj', 'totalm'));
			return $pdf->setPaper('a4')->download('INVOICE-'.$data->kode_tagihan.'.pdf');

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
                                ->orderby('tanggal_so', 'asc')
                                ->get();
            }
            
            $pdf = PDF::loadview('keuangan.pemasukan.rekap', compact('sot'));
            return $pdf->setPaper('a4')->download('Pemasukan.pdf');

        } else if ($request->route == 'order-barang') {
            
			$transaksi = PoTransaksi::findOrFail($id);
			$details = PoTransaksiBarang::where('po_transaksi_id', $id)->get();
			$title     = 'Purchase Order No. ' . $transaksi->po_transaksi;
			
			$pdf = PDF::loadview('order-barang.print', compact('transaksi', 'details', 'title'));
			// return view('order-barang.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('PO-'.$transaksi->po_transaksi.'.pdf');

        } else if ($request->route == 'order-material') {
            
			$transaksi = Material::findOrFail($id);
			$details   = MaterialBarang::where('material_id', $id)->get();
			$title     = 'Pengajuan Pembayaran No. ' . $transaksi->ma_transaksi;
			
			$pdf = PDF::loadview('order-material.print', compact('transaksi', 'details', 'title'));
			// return view('order-material.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('Pengajuan-Pembayaran-'.$transaksi->ma_transaksi.'.pdf');

        } else if ($request->route == 'barang-masuk') {
            
			$sot = BarangMasuk::findOrFail($id);
			$dbm = BarangMasukDetail::where('barang_masuk_id', $id)->get();
			
			$barang = PoTransaksiBarang::where('po_transaksi_id', $sot->po_transaksi_id)
										->whereNotExists(function($query) {
											$query->selectRaw('barang_masuk_details.po_transaksi_barang_id')
												->from('barang_masuk_details')
												->whereRaw('po_transaksi_barangs.id = barang_masuk_details.po_transaksi_barang_id');
										})
										->where('po_quantity', '>', 0)
										->get();

			$title = 'Detail: No. ' . $sot->bbm_transaksi;
			$route = 'barang-masuk';
			
			
			$pdf = PDF::loadview('barang-masuk.print',  compact('title', 'sot', 'sob', 'dbm', 'barang'));
			return $pdf->setPaper('a4')->download('BBM-PO-'.$sot->bbm_transaksi.'.pdf');

        } else if ($request->route == 'bukti-material') {
            
			$sot = BuktiMaterial::findOrFail($id);
			$dbm = BuktiMaterialDetail::where('bukti_material_id', $id)->get();
			
			$barang = MaterialBarang::where('material_id', $sot->material_id)
										->where('ma_quantity', '>', 0)
										->whereNotExists(function($query) {
											$query->selectRaw('bukti_material_details.material_barang_id')
												->from('bukti_material_details')
												->whereRaw('bukti_material_details.material_barang_id = material_barangs.id');
										})
										->get();

			$title = 'No. ' . $sot->bbm_material;
			
			$pdf = PDF::loadview('bukti-material.print',  compact('title', 'sot', 'sob', 'dbm', 'barang'));
			// return view('order-barang.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('BBM-Pengajuan-'.$sot->bbm_material.'.pdf');

        } else if ($request->route == 'barang-keluar') {
            
			$sot = BarangKeluar::findOrFail($id);
			$dbm = BarangKeluarDetail::where('barang_keluar_id', $id)->get();

			$title = 'No. ' . $sot->bbk_transaksi;
			
			
			$pdf = PDF::loadview('barang-keluar.print',  compact('title', 'sot', 'sob', 'dbm'));
			// return view('order-barang.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('BBK-PO-'.$sot->bbk_transaksi.'.pdf');

        } else if ($request->route == 'bukti-keluar') {
            
			$sot = BuktiKeluar::findOrFail($id);
			$dbm = BuktiKeluarDetail::where('bukti_keluar_id', $id)->get();

			$title = 'No. ' . $sot->bbk_material;
			
			$pdf = PDF::loadview('bukti-keluar.print',  compact('title', 'sot', 'sob', 'dbm'));
			// return view('order-barang.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('BBK-Pengajuan-'.$sot->bbk_material.'.pdf');

        } else if ($request->route == 'pengeluaran') {
            
			$pen   = Pengeluaran::findOrFail($id);

			$utang = Utang::where('sisa', '>', 0)->get();
			$operasional = Operasional::where('deleted', 'N')->pluck('nama_operasional', 'id');
	
			$op   = PengeluaranOperasional::where('pengeluaran_id', $id)->get();
			$sp   = PengeluaranSuplier::where('pengeluaran_id', $id)->get();
			$csp  = $sp->count();
			$cop  = $op->count();
			
			$pdf = PDF::loadview('keuangan.pengeluaran.print',  compact('op', 'sp', 'csp', 'cop', 'pen'));
			// return view('order-barang.print', compact('transaksi', 'details', 'title'));
			return $pdf->setPaper('a4')->download('Pengeluaran-'.$pen->no_transaksi.'.pdf');

        } // end if
    }
}

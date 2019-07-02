<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\SoTransaksi;
use App\SoKendaraan;
use App\PoTransaksi;
use App\Material;
use App\MaterialBarang;
use App\Tagihan;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;
use App\Asuransi;
use App\Pengeluaran;
use App\Pemasukan;
use App\Suplier;
use App\Operasional;
use App\Satuan;
use App\Barang;
use App\Merek;
use App\SoPelanggan;
use Illuminate\Http\Request;

class CariController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kata_kunci = $request->kata_kunci;

        if ($request->route == 'pre-so') {
            $title = 'Unit Lapor - Pencarian ' . $kata_kunci;
            $route = 'pre-so';
            $cari = 'cari-preso';
            
            $sot = SoTransaksi::where('status', '1')
                            ->join('so_kendaraans', function ($join) use ($kata_kunci) {
                                $join->on('so_transaksis.so_kendaraan_id', '=', 'so_kendaraans.id')
                                    ->where('so_kendaraans.no_polisi', 'LIKE', '%' . $kata_kunci . '%');
                                    })
                            ->orderBy('tanggal_pre', 'asc')
                            ->get();

            return view($route . '.cari', compact('title', 'cari', 'sot', 'route'));

        } else if ($request->route == 'servis-order') {
            $title = 'Surat Perintah Kerja - Pencarian ' . $kata_kunci;
            $route = 'servis-order';
            $cari = 'cari-so';
            
            $sot = SoTransaksi::where('status', '2')
                            ->join('so_kendaraans', function ($join) use ($kata_kunci) {
                                $join->on('so_transaksis.so_kendaraan_id', '=', 'so_kendaraans.id')
                                    ->where('so_kendaraans.no_polisi', 'LIKE', '%' . $kata_kunci . '%');
                                    })
                            ->orderBy('tanggal_pre', 'asc')
                            ->get();

            return view($route . '.cari', compact('title', 'cari', 'sot', 'route'));

        } else if ($request->route == 'ekstimasi') {
            $title = 'Estimasi - Pencarian ' . $kata_kunci;
            $route = 'ekstimasi';
            $cari = 'cari-ekstimasi';
            
            $ekstimasi = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')
                            ->whereNotNull('tanggal_invoice')
                            ->join('so_kendaraans', function ($join) use ($kata_kunci) {
                                $join->on('so_transaksis.so_kendaraan_id', '=', 'so_kendaraans.id')
                                    ->where('so_kendaraans.no_polisi', 'LIKE', '%' . $kata_kunci . '%');
                                    })
                            ->orderby('tanggal_invoice', 'asc')
                            ->get();

            return view($route . '.cari', compact('title', 'cari', 'ekstimasi', 'route'));

        } else if ($request->route == 'order-barang') {
            $title = 'Purchase Order - Pencarian ' . $kata_kunci;
            $route = 'order-barang';
            $cari = 'cari-order-barang';
            
            $order = PoTransaksi::where('po_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                    ->orderBy('tanggal_masuk', 'asc')
                    ->get();

            return view($route . '.cari', compact('title', 'order', 'cari', 'route'));

        } else if ($request->route == 'order-material') {
            $title = 'Pengajuan Pembayaran - Pencarian ' . $kata_kunci;
            $route = 'order-material';
            $cari = 'cari-order-material';
            
            $order_material = Material::where('ma_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                    ->orderBy('tanggal_masuk', 'asc')
                    ->get();

                    foreach ($order_material as $data) {
                        $detail_barang = MaterialBarang::get();
                        $tagihan_barang = 0;
                        $total_barang = 0;
                        foreach($detail_barang as $datab) {
                            $tagihan_barang = ( $datab->harga_transaksi - ($datab->harga_transaksi * $datab->diskon / 100) ) * $datab->ma_quantity;
                            $total_barang += $tagihan_barang;
                        }
                        $totalm = $total_barang;
                    }

            return view($route . '.cari', compact('title', 'order_material', 'cari', 'totalm', 'route'));

        } else if ($request->route == 'tagihan') {
            $title = 'Invoice - Pencarian ' . $kata_kunci;
            $route = 'tagihan';
            $cari = 'cari-invoice';
            
            $tagihans = Tagihan::join('so_transaksis', function ($join) {
                                    $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id')
                                         ->where('tagihans.deleted', 'N');
                                })
                                ->join('so_kendaraans', function ($join) use ($kata_kunci) {
                                    $join->on('so_transaksis.so_kendaraan_id', '=', 'so_kendaraans.id');
                                         
                                })
                                ->join('so_pelanggans', function ($join) use ($kata_kunci) {
                                    $join->on('so_kendaraans.so_pelanggan_id', '=', 'so_pelanggans.id');
                                         
                                })
                                ->where('so_kendaraans.no_polisi', 'LIKE', '%' . $kata_kunci . '%')
                                ->orWhere('so_pelanggans.nama_pelanggan', 'LIKE', '%' . $kata_kunci . '%')
                                ->orderBy('tanggal_masuk', 'asc')
                                ->get();
								
            foreach ($tagihans as $data) {
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
            }
    
            $asuransi  = Asuransi::where('deleted', 'N')->pluck('nama_asuransi', 'id')->all();

            return view($route . '.cari', compact('title', 'route', 'totalb', 'asuransi', 'totalj', 'cari', 'totalm', 'tagihans'));

        } else if ($request->route == 'tagihan-or') {
            $title = 'Tagihan OR - Pencarian ' . $kata_kunci;
            $route = 'tagihan-or';
            $cari  = 'cari-tagihan-or';
            

            $tagihans = Tagihan::join('so_transaksis', function ($join) {
                                    $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id')
                                         ->where('tagihans.deleted', 'N');
                                })
                                ->join('so_kendaraans', function ($join) use ($kata_kunci) {
                                    $join->on('so_transaksis.so_kendaraan_id', '=', 'so_kendaraans.id');
                                         
                                })
                                ->join('so_pelanggans', function ($join) use ($kata_kunci) {
                                    $join->on('so_kendaraans.so_pelanggan_id', '=', 'so_pelanggans.id');
                                         
                                })
                                ->whereNotNull('tagihans.jumlah_or')
                                ->where('so_kendaraans.no_polisi', 'LIKE', '%' . $kata_kunci . '%')
                                ->orWhere('so_pelanggans.nama_pelanggan', 'LIKE', '%' . $kata_kunci . '%')
                                ->orderBy('tanggal_masuk', 'asc')
                                ->get();
                    
            return view($route . '.cari', compact('title', 'route', 'cari', 'tagihans'));

        } else if ($request->route == 'pengeluaran') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Pengeluaran - Pencarian ' . $kata_kunci;
            $route = 'pengeluaran';
            $cari  = 'cari-pengeluaran';
            
            $pengeluaran = Pengeluaran::where('keterangan_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                                      ->orderBy('tanggal_masuk', 'asc')
                                      ->get();
    
            return view('keuangan.' . $route . '.cari', compact('title', 'cari', 'pengeluaran', 'route'));

        } else if ($request->route == 'pemasukan') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Pemasukan - Pencarian ' . $kata_kunci;
            $route = 'pemasukan';
            $cari  = 'cari-pemasukan';
            
            $pemasukan = Pemasukan::where('keterangan', 'LIKE', '%' . $kata_kunci . '%')
                                  ->orderBy('tanggal_masuk', 'asc')
                                  ->get();
    
            return view('keuangan.' . $route . '.cari', compact('title', 'cari', 'pemasukan', 'route'));

        } else if ($request->route == 'suplier') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Supplier - Pencarian ' . $kata_kunci;
            $route = 'suplier';
            $cari  = 'cari-suplier';
            
            $suplier = Suplier::where('deleted', 'N')
                          ->where('nama_suplier', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('kode_suplier', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('kode_suplier', 'asc')
                          ->get();
            
            return view($route . '.cari', compact('title', 'suplier', 'cari', 'route'));

        } else if ($request->route == 'asuransi') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Asuransi - Pencarian ' . $kata_kunci;
            $route = 'asuransi';
            $cari  = 'cari-asuransi';
            
            $asuransi = Asuransi::where('deleted', 'N')
                          ->where('nama_asuransi', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('kode_asuransi', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('kode_asuransi', 'asc')
                          ->get();
                          
            return view($route . '.cari', compact('title', 'asuransi', 'cari', 'route'));

        } else if ($request->route == 'operasional') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Operasional - Pencarian ' . $kata_kunci;
            $route = 'operasional';
            $cari  = 'cari-operasional';
            
            $operasional = Operasional::where('deleted', 'N')
                          ->where('nama_operasional', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('nama_operasional', 'asc')
                          ->get();
    
            return view($route . '.cari', compact('title', 'operasional', 'cari', 'route'));

        } else if ($request->route == 'satuan') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Satuan - Pencarian ' . $kata_kunci;
            $route = 'satuan';
            $cari  = 'cari-satuan';
            
            $satuan = Satuan::where('deleted', 'N')
                          ->where('nama_satuan', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('kode_satuan', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('kode_satuan', 'asc')
                          ->get();
                          
            return view($route . '.cari', compact('title', 'satuan', 'cari', 'route'));

        } else if ($request->route == 'barang') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Barang - Pencarian ' . $kata_kunci;
            $route = 'barang';
            $cari  = 'cari-barang';
            
            $barang = Barang::where('deleted', 'N')
                          ->where('nama_barang', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('kode_barang', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('no_part_barang', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('kode_barang', 'asc')
                          ->get();
    
            return view($route . '.cari', compact('title', 'cari', 'barang', 'route'));

        } else if ($request->route == 'merek') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Merek - Pencarian ' . $kata_kunci;
            $route = 'merek';
            $cari  = 'cari-merek';
            
            $merek = Merek::where('deleted', 'N')
                          ->where('nama_merek', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('unit_merek', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('kode_merek', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('kode_merek', 'asc')
                          ->get();
    
            return view($route . '.cari', compact('title', 'cari', 'merek', 'route'));

        } else if ($request->route == 'kendaraan') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Kendaraan - Pencarian ' . $kata_kunci;
            $route = 'kendaraan';
            $cari  = 'cari-kendaraan';
            
            $kendaraan = SoKendaraan::where('deleted', 'N')
                          ->where('no_polisi', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('no_rangka', 'LIKE', '%' . $kata_kunci . '%')
                          ->orWhere('no_mesin', 'LIKE', '%' . $kata_kunci . '%')
                          ->orderBy('id', 'asc')
                          ->get();
    
            return view($route . '.cari', compact('title', 'cari', 'kendaraan', 'route'));

        } else if ($request->route == 'pelanggan') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Pelanggan - Pencarian ' . $kata_kunci;
            $route = 'pelanggan';
            $cari  = 'cari-pelanggan';
            
            $pelanggan = SoPelanggan::where('deleted', 'N')
                                ->where('nama_pelanggan', 'LIKE', '%' . $kata_kunci . '%')
                                ->orWhere('no_claim', 'LIKE', '%' . $kata_kunci . '%')
                                ->orderBy('nama_pelanggan', 'asc')
                                ->get();
    
            return view($route . '.cari', compact('title', 'cari', 'pelanggan', 'route'));

        } else if ($request->route == 'jejak-pelanggan') {
            $kata_kunci = $request->kata_kunci;
            $title = 'Jejak Pelanggan - Pencarian ' . $kata_kunci;
            $route = 'jejak-pelanggan';
            $cari  = 'cari-jejak-pelanggan';
            
            $sot   = Tagihan::join('so_transaksis', function ($join) {
                                    $join->on('tagihans.so_transaksi_id', '=', 'so_transaksis.id')
                                         ->where('tagihans.deleted', 'N');
                                })
                                ->join('so_kendaraans', function ($join) use ($kata_kunci) {
                                    $join->on('so_transaksis.so_kendaraan_id', '=', 'so_kendaraans.id')
                                         ->where('so_kendaraans.no_polisi', 'LIKE', '%' . $kata_kunci . '%');
                                })
                                ->orderBy('tanggal_masuk', 'asc')
                                ->get();
    
            return view($route . '.cari', compact('title', 'cari', 'sot', 'route'));

        }
    }
}
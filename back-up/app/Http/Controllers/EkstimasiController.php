<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\SoTransaksiBarang;
use App\SoTransaksiJasa;
use App\SoPelanggan;
use App\SoKendaraan;
use App\Tagihan;
use App\Permission;
use App\Barang;
use App\SoDetail;
use Auth;
use Session;
use PDF;

class EkstimasiController extends Controller
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

        $route     = 'ekstimasi';
        $title     = 'Pre Invoice';
        $ekstimasi = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')
                                ->whereNotNull('tanggal_invoice')
                                ->orderby('tanggal_invoice', 'asc')
                                ->paginate(20);
        
        return view($route . '.index', compact('title', 'ekstimasi', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modul_id = 2;
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

        $title     = 'Tambah Pre Invoice';
        $button    = 'Tambah';
        $route     = 'ekstimasi';

        $result      = SoTransaksi::whereNotNull('tanggal_so')->whereNull('tanggal_invoice')->orderBy('id', 'ASC')->get();
        $invoice     = [];
        foreach ( $result as $v ) {
            if ( !isset($invoice[$v->sokendaraan->sopelanggan->nama_pelanggan]) ) {
                $invoice[$v->sokendaraan->sopelanggan->nama_pelanggan] = [];
            }
            $invoice[$v->sokendaraan->sopelanggan->nama_pelanggan][$v->id] = $v->no_transaksi . ' - ' . $v->sokendaraan->no_polisi;
            $bid[$v->sokendaraan->sopelanggan->nama_pelanggan][$v->id] = $v->id;
        }
        
        return view('template.create', compact('title', 'button', 'route', 'invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'tanggal_invoice' => 'required'
        ]);
        
        $transaksi = SoTransaksi::findOrFail($request->id);
        $transaksi->tanggal_invoice = $request->tanggal_invoice;
		$transaksi->ppn = $request->ppn;
        $transaksi->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menyetujui Servis Order"
            ]);
        
        return redirect('ekstimasi/'. $request->id .'/edit/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modul_id = 3;
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

        $sot   = SoTransaksi::findOrFail($id);
        $details = SoDetail::where('so_transaksi_id', $id)->get();

        $detail_barang   = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '2')->get();
        $detail_material = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '1')->get();
        $detail_jasa     = SoTransaksiJasa::where('so_transaksi_id', $id)->get();
        $count_jasa    = SoTransaksiJasa::where('so_transaksi_id', $id)->count();
        $count_barang  = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '2')->count();
        $count_material  = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '1')->count();
        
        $title = 'Detail: No. ' . $sot->no_transaksi;
        $route = 'ekstimasi';
        
        return view($route . '.show', compact('title', 'sot', 'route', 'details', 'detail_barang', 'detail_jasa', 'detail_material', 'count_material', 'count_jasa', 'count_barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modul_id = 4;
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

        $title     = 'Ubah Pre Invoice';
        $button    = 'Tambah';
        $route     = 'ekstimasi';

        $ekstimasi = SoTransaksi::findOrFail($id);
        $detail_barang   = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '2')->get();
        $detail_material = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '1')->get();
        $detail_jasa     = SoTransaksiJasa::where('so_transaksi_id', $id)->get();
        $count_jasa    = SoTransaksiJasa::where('so_transaksi_id', $id)->count();
        $count_barang  = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '2')->count();
        $count_material  = SoTransaksiBarang::where('so_transaksi_id', $id)->where('kategori_transaksi', '1')->count();

        $barang = Barang::where('kategori_barang', '2')
                        ->get();
        
        $materials = Barang::where('kategori_barang', '1')
                        ->get();
        
        
        return view('ekstimasi.edit', compact('title', 'ekstimasi', 'route', 'barang', 'button', 'materials', 'detail_barang', 'detail_jasa', 'detail_material', 'count_material', 'count_jasa', 'count_barang', 'tagihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ( ! empty($request->kegiatan) ) {
            
            $this->validate($request, [
                'kegiatan' => 'required',
                'quantity' => 'required',
                'harga_transaksi' => 'required'
            ]);
            
            $data = SoTransaksiJasa::firstOrCreate([
                'so_transaksi_id'    => $id,
                'kategori_transaksi' => '1',
                'kegiatan'           => $request->kegiatan,
                'quantity'           => $request->quantity,
                'diskon'             => empty($request->diskon) ? "0" : $request->diskon,
                'harga_transaksi'    => $request->harga_transaksi,
                'keterangan_transaksi' => $request->keterangan_transaksi
            ]);

            
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, menambah transaksi jasa servis order"
            ]);

        } else if ( ! empty($request->barang_id) ) {
            $this->validate($request, [
                'barang_id' => 'required',
                'quantity'  => 'required'
            ]);
            $barang = Barang::findOrFail($request->barang_id);
            // if (SoTransaksiBarang::where('so_transaksi_id', $id)->where('barang_id', $request->barang_id)->get()->count() == 0) {

                $data = SoTransaksiBarang::firstOrCreate([
                    'so_transaksi_id'    => $id,
                    'kategori_transaksi' => $barang->kategori_barang,
                    'barang_id'          => $request->barang_id,
                    'quantity'           => $request->quantity,
                    'diskon'             => empty($request->diskon) ? "0" : $request->diskon,
                    'keterangan_transaksi' => $request->keterangan_transaksi,
                    'harga_transaksi'    => $barang->harga_jual
                ]);
                

            // } else {
            //     $transaksi_barang = SoTransaksiBarang::findOrFail($transaksi->id);
            //     $transaksi_barang->quantity += $request->quantity;
            //     $transaksi_barang->keterangan_transaksi = $request->keterangan_transaksi;
            //     $transaksi_barang->update();
            // }
            
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, menambah transaksi barang servis order"
                ]);
        }

        $transaksi = SoTransaksi::findOrFail($id);
        $transaksi->jumlah_estimasi += ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity;
        $transaksi->update();
        
        return redirect('ekstimasi/'. $id .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul_id = 5;
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
    }
        
    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request)
    {
        $kata_kunci = $request->kata_kunci;
        $title = 'Estimasi - Pencarian ' . $kata_kunci;
        $route = 'ekstimasi';
        
        $ekstimasi = SoTransaksi::where('no_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                    ->orderBy('no_transaksi', 'asc')
                    ->paginate(20);

        return view('ekstimasi.index', compact('title', 'ekstimasi', 'route'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
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
        return $pdf->setPaper('f4')->download('Pre-Invoice-'.$sot->no_transaksi.'.pdf');
    }
}

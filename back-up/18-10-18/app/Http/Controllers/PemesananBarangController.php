<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use View;
use Session;
use App\SoTransaksi;
use App\PoTransaksi;
use App\Barang;
use App\SoKendaraan;
use App\Suplier;
use App\Permission;
use Auth;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;

class PemesananBarangController extends Controller
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

        $route  = 'order-barang';
        $title  = 'Purchase Order';
        $cari   = 'cari-order-barang';

        $order  = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/SO%')->orderby('tanggal_masuk', 'asc')->paginate(20);

        foreach ($order as $data) {
            $detail_barang = PoTransaksiBarang::where('po_transaksi_id', $data->id)->get();
            $tagihan_barang = 0;
            $total_barang = 0;
            foreach($detail_barang as $datab) {
                $tagihan_barang = ( $datab->barang->harga_beli - ($datab->barang->harga_beli * $datab->diskon / 100) ) * $datab->po_quantity;
                $total_barang += $tagihan_barang;
            }
            $totalm = $total_barang;
        }

        return view($route . '.index', compact('title', 'cari', 'order', 'totalm', 'route'));
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

        $route   = 'order-barang';
        $title   = 'Tambah Purchase Order';
        
        $suplier = Suplier::where('deleted', 'N')->pluck('nama_suplier', 'id')->all();

        $cari   = PoTransaksi::where('po_transaksi', 'LIKE', '%SBS' . date('Y') . '-PO/SO%')->orderby('id', 'desc')->first();
        if ( is_null($cari) ) {
            $add = 1;
        } else {
            $add = $cari->id + 1;
        }
        $kode = 'SBS' . date('Y') . '-PO/SO' . sprintf("%04s", $add);

        $button  = 'Selanjutnya';
        
        return view('template.create', compact('title', 'button', 'route', 'kode', 'suplier'));
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
            'suplier_id' => 'required',
            'tanggal_masuk' => 'required',
            'po_transaksi' => 'required|unique:po_transaksis'
        ]);

        $po = PoTransaksi::firstOrCreate([
            'po_transaksi' => $request->po_transaksi,
            'suplier_id'      => $request->suplier_id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total' => '0'
        ]);
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data Order <strong>$po->po_transaksi</strong>"
        ]);

        return redirect('order-barang/' . $po->id . '/edit');
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

        $route  = 'order-barang';
        $title  = 'Detail Purchase Order';
        $button = 'Tambah';
        $controller = 'PemesananBarangController';
        
        $sot = PoTransaksi::findOrFail($id);
        $order_barang = PoTransaksiBarang::where('po_transaksi_id', $id)
                                            ->get();

        return view($route . '.show', compact('title', 'controller', 'route', 'sot', 'button', 'order_barang'));
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

        $route  = 'order-barang';
        $title  = 'Tambah Purchase Order';
        $button = 'Tambah';
        $controller = 'PemesananBarangController';
        
        $order = PoTransaksi::findOrFail($id);
        $order_barang = PoTransaksiBarang::where('po_transaksi_id', $id)->get();


        $barang = Barang::where('deleted', 'N')->pluck('nama_barang', 'id')->all();
        $result      = SoKendaraan::where('deleted', 'N')->orderBy('id', 'asc')->get();
        $kendaraan   = [];
        foreach ( $result as $v ) {
            if ( !isset($kendaraan[$v->no_polisi]) ) {
                $kendaraan[$v->no_polisi] = [];
            }
            $kendaraan[$v->sopelanggan->nama_pelanggan][$v->id] = $v->no_polisi;
            $pelanggan[$v->sopelanggan->nama_pelanggan][$v->id] = $v->id;
        }

        return view($route . '.edit', compact('title', 'controller', 'route', 'order', 'kendaraan', 'button', 'order_barang', 'barang'));
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
        $this->validate($request, [
            'so_kendaraan_id' => 'required',
            'barang_id' => 'required'
        ]);

        $potransaksi = PoTransaksiBarang::where('po_transaksi_id', $id)
                                        ->where('barang_id', $request->barang_id)
                                        ->where('so_kendaraan_id', $request->so_kendaraan_id);


        if ( empty($request->diskon) ) {
            $diskon = 0;
        } else {
            $diskon = $request->diskon;
        }

        empty($request->quantity) ? $qty = '1' : $qty = $request->quantity;
        
        if ( $potransaksi->count() == 0 ) {
            $po = PoTransaksiBarang::firstOrCreate([
                'so_kendaraan_id' => $request->so_kendaraan_id,
                'po_transaksi_id' => $id,
                'po_quantity'     => $qty,
                'diskon'          => $diskon,
                'barang_id'       => $request->barang_id,
                'keterangan_transaksi' => $request->keterangan_transaksi
            ]);

            $order = PoTransaksi::findOrFail($id);
            $order->total += ( $po->barang->harga_beli - ($po->barang->harga_beli * $po->diskon / 100) ) * $po->po_quantity;
            $order->update();

            $info  = "success";
            $pesan = "Berhasil, memperbarui data Order <strong> " . $po->barang->nama_barang . "</strong>";

        } else {
            $pt = PoTransaksiBarang::firstOrNew([
                'barang_id' => $request->barang_id,
                'so_kendaraan_id' => $request->so_kendaraan_id,
                'diskon'          => $diskon,
                'po_transaksi_id' => $id,
                'keterangan_transaksi' => $request->keterangan_transaksi
            ]);
            $pt->po_quantity += $qty;
            $pt->save();

            $order = PoTransaksi::findOrFail($id);
            $order->total += ( $pt->barang->harga_beli - ($pt->barang->harga_beli * $pt->diskon / 100) ) * $pt->po_quantity;
            $order->update();

            $info = "success";
            $pesan = "Berhasil, memperbarui data Order <strong> " . $pt->barang->nama_barang . "</strong>";
        }
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-" . $info,
            "message"   => $pesan
        ]);

        return redirect('order-barang/' . $id . '/edit');
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

        $pot = PoTransaksi::findOrFail($id);
        $pot->delete();

        $data = PoTransaksiBarang::where('po_transaksi_id', $id)->get();
        foreach($data as $d) {
            $d->delete();
        }
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Pemesanan Barang <strong>$pot->po_transaksi</strong>"
            ]);
        
        return redirect('order-barang/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
		//
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
        $title = 'Purchase Order - Pencarian ' . $kata_kunci;
        $route = 'order-barang';
        
        $order = PoTransaksi::where('po_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                    ->orderBy('tanggal_masuk', 'asc')
                    ->paginate(20);

        return view($route.'.index', compact('title', 'order', 'route'));
    }
}

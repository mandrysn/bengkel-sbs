<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use View;
use Session;
use App\SoKendaraan;
use App\SoTransaksi;
use App\PoTransaksi;
use App\Barang;
use App\Suplier;
use App\Permission;
use App\Asuransi;
use Auth;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;

class PoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $route   = 'po';
        $title   = 'Tambah Purchase Order';
        $button  = 'Tambah';

        $cari   = PoTransaksi::where('po_transaksi', 'LIKE', '%SBS' . date('Y') . '-PO/SO%')->orderby('id', 'desc')->first();
        if ( is_null($cari) ) {
            $add = 1;
        } else {
            $add = $cari->id + 1;
        }
        $kode = 'SBS' . date('Y') . '-PO/SO' . sprintf("%04s", $add);

        $cari_so = SoTransaksi::where('no_transaksi', 'LIKE', '%SBS' . date('Y') . '-SO%')->count();
        if($cari_so < 0 ) {
            $add_so = 1;
        } else {
            $add_so = $cari_so + 1;
        }
        $no_transaksi = 'SBS' . date('Y') . '-SO' . sprintf("%04s", $add_so);
        
        $suplier = Suplier::where('deleted', 'N')->pluck('nama_suplier', 'id')->all();

        return view('template.create', compact('title', 'button', 'route', 'no_transaksi', 'suplier', 'kode'));
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
        
        // INSERT RECORD PO
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

        return redirect('po/' . $po->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $route  = 'po';
        $title  = 'Tambah Purchase Order';
        $button = 'Tambah';
        $controller = 'PoController';

        $barang = Barang::where('deleted', 'N')->get();
        $order  = PoTransaksi::findOrFail($id);

        $asuransi    = Asuransi::where('deleted', 'N')->pluck('nama_asuransi', 'id')->all();
        $result      = SoKendaraan::where('deleted', 'N')->orderBy('id', 'asc')->get();
        $kendaraan   = [];
        foreach ( $result as $v ) {
            if ( !isset($kendaraan[$v->no_polisi]) ) {
                $kendaraan[$v->no_polisi] = [];
            }
            $kendaraan[$v->sopelanggan->nama_pelanggan][$v->id] = $v->no_polisi;
            $pelanggan[$v->sopelanggan->nama_pelanggan][$v->id] = $v->id;
        }

        $po   = PoTransaksiBarang::where('po_transaksi_id', $id)->get();
        $total = 0;

        return view($route . '.edit', compact('title', 'controller', 'route', 'asuransi', 'kendaraan', 'barang', 'order', 'button', 'po', 'total'));
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
            'barang_id' => 'required',
            'quantity'  => 'required',
            'so_kendaraan_id' => 'required',
            'asuransi_id' => 'required'
        ]);
        
        $barang = Barang::findOrFail($request->barang_id);
        $diskon = empty($request->diskon) ? "0.0" : $request->diskon;

        // INSERT RECORD PO
        $potransaksi = PoTransaksiBarang::where('po_transaksi_id', $id)
                                        ->where('barang_id', $request->barang_id);

        if ( $potransaksi->count() == 0 ) {
            $po = PoTransaksiBarang::firstOrCreate([
                'po_transaksi_id' => $id,
                'po_quantity'     => $request->quantity,
                'diskon'          => $diskon,
                'barang_id'       => $request->barang_id,
                'keterangan_transaksi' => $request->keterangan_transaksi
            ]);

            $order = PoTransaksi::findOrFail($id);
            $order->total += ( $po->barang->harga_beli - ($po->barang->harga_beli * $po->diskon / 100) ) * $po->po_quantity;
            $order->update();

            $info = "success";
            $pesan = "Berhasil, memperbarui data Order <strong> " . $barang->nama_barang . "</strong>";

        } else {
            $pt = PoTransaksiBarang::firstOrNew([
                'barang_id' => $request->barang_id,
                'diskon'          => $diskon,
                'po_transaksi_id' => $id,
                'keterangan_transaksi' => $request->keterangan_transaksi
            ]);
            $pt->po_quantity += $request->quantity;
            $pt->save();

            $order = PoTransaksi::findOrFail($id);
            $order->total += ( $pt->barang->harga_beli - ($pt->barang->harga_beli * $pt->diskon / 100) ) * $pt->po_quantity;
            $order->update();

            $info = "success";
            $pesan = "Berhasil, memperbarui data Order <strong> " . $barang->nama_barang . "</strong>";
        }
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-" . $info,
            "message"   => $pesan
        ]);
        
        return redirect('po/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

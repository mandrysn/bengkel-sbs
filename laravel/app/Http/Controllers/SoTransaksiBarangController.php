<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiBarang;
use App\Barang;
use Session;
use App\Permission;
use Auth;

class SoTransaksiBarangController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

        $this->validate($request, [
            'barang_id'  => 'required',
            'quantity'   => 'required'
        ]);

        $transaksibarang = SoTransaksiBarang::findOrFail($request->barang_id);
        $transaksibarang->quantity      = $request->quantity;
        $transaksibarang->keterangan_transaksi = $request->keterangan_transaksi;
        $transaksibarang->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Barang <strong> $transaksibarang->quantity ".$transaksibarang->barang->satuan->nama_satuan." ".$transaksibarang->barang->nama_barang.", $request->keterangan_transaksi</strong>"
            ]);
        
        return redirect('servis-order/'. $transaksibarang->so_transaksi_id .'/edit/');
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

        $data = SoTransaksiBarang::findOrFail($id);
        $data->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Transaksi Barang <strong>$data->quantity ".$data->barang->satuan->nama_satuan." ".$data->barang->nama_barang.", $data->keterangan_transaksi</strong>"
            ]);
        
        return redirect('servis-order/'. $data->so_transaksi_id .'/edit/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiJasa;
use Session;

class SoTransaksiJasaController extends Controller
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
        $this->validate($request, [
            'jasa_id'    => 'required',
            'keterangan' => 'required',
            'quantity'   => 'required'
        ]);

        $transaksijasa = SoTransaksiJasa::findOrFail($request->jasa_id);
        $transaksijasa->quantity = $request->quantity;
        $transaksijasa->keterangan_transaksi = $request->keterangan_transaksi;
        $transaksijasa->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Jasa <strong>$request->quantity Kali $transaksijasa->kegiatan, $transaksijasa->keterangan_transaksi</strong>"
            ]);
        
        return redirect('servis-order/'. $transaksijasa->so_transaksi_id .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SoTransaksiJasa::findOrFail($id);
        $data->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Transaksi Jasa <strong>$data->quantity Kali ".$data->kegiatan.", $data->keterangan_transaksi</strong>"
            ]);
        
        return redirect('servis-order/'. $data->so_transaksi_id .'/edit/');
    }
}

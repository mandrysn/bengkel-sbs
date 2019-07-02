<?php

namespace App\Http\Controllers;

use App\SoTransaksiBarang;
use App\PoTransaksiBarang;
use Session;
use App\Permission;
use App\MaterialBarang;
use Auth;
use Illuminate\Http\Request;

class MaTransaksiDetailController extends Controller
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
     * @param  \App\MaTransaksiDetail  $maTransaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function show(MaTransaksiDetail $maTransaksiDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaTransaksiDetail  $maTransaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(MaTransaksiDetail $maTransaksiDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaTransaksiDetail  $maTransaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $maTransaksiDetail)
    {

        $this->validate($request, [
            'so_transaksi_id' => 'required',
            'so_transaksi_barang_id' => 'required',
            'quantity'   => 'required'
        ]);

        $transaksibarang = SoTransaksiBarang::findOrFail($request->so_transaksi_barang_id);
        $transaksibarang->quantity   = $request->quantity;
        $transaksibarang->keterangan_transaksi = $request->keterangan_transaksi;
        $transaksibarang->update();

        $transaksipo = PoTransaksiBarang::where('so_transaksi_barang_id', $request->so_transaksi_barang_id)->first();
        $transaksipo->po_quantity   = $request->quantity;
        $transaksipo->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Barang <strong> $transaksibarang->quantity ".$transaksibarang->barang->satuan->nama_satuan." ".$transaksibarang->barang->nama_barang.", $request->keterangan_transaksi</strong>"
            ]);
        
        return redirect('order-material/'. $transaksipo->po_transaksi_id .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaTransaksiDetail  $maTransaksiDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = MaterialBarang::findOrFail($id);
        $data->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Pemesanan Barang"
            ]);
        
        return redirect('order-material/'. $data->material_id .'/edit/');
    }
}

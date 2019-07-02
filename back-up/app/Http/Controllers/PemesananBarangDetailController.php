<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;
use Session;
use App\Permission;
use Auth;

class PemesananBarangDetailController extends Controller
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
            'po_quantity' => 'required'
        ]);

        $potransaksi = PoTransaksiBarang::findOrFail($id);
        $potransaksi->po_quantity = $request->po_quantity;
        $potransaksi->update();
        
        $sotransaksi = SoTransaksiBarang::findOrFail($potransaksi->so_transaksi_barang_id);
        $hitung = ($sotransaksi->quantity - $sotransaksi->quantity_po) - $request->po_quantity;
        $sotransaksi->quantity_po = $hitung;
            $sotransaksi->update();

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, memperbarui data Order <strong> " . $sotransaksi->barang->nama_barang . ", " . $sotransaksi->quantity_po . " " . $sotransaksi->barang->satuan->nama_satuan . "</strong>"
        ]);

        return redirect('order-barang/'.$potransaksi->po_transaksi_id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = PoTransaksiBarang::findOrFail($id);
        $data->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Pemesanan Barang"
            ]);
        
        return redirect('order-barang/'. $data->po_transaksi_id .'/edit/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiBarang;
use Session;

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
            'quantity_po' => 'required',
            'po_transaksi_id' => 'required'
        ]);
        
        $sotransaksi = SoTransaksiBarang::findOrFail($id);

        if ($request->quantity_po > $sotransaksi->quantity ) {
            $info = 'alert';
            $pesan = "Gagal, Jumlah yang dimasukkan melebihi Jumlah yang dipesan";
        } else {
            $sotransaksi->quantity_po = $request->quantity_po;
            $sotransaksi->update();

            $info = 'success';
            $pesan = "Berhasil, memperbarui data Order <strong> " . $sotransaksi->barang->nama_barang . ", " . $sotransaksi->quantity_po . " " . $sotransaksi->barang->satuan->nama_satuan . "</strong>";
        }

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-$info",
            "message"   => $pesan
        ]);

        return redirect('order-barang/'.$request->po_transaksi_id.'/edit');
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

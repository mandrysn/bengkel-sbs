<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiBarang;
use App\Barang;
use App\BarangMasuk;
use App\Gudang;
use Session;

class BarangMasukDetailController extends Controller
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
            'harga_bm'   => 'required',
            'quantity_bm'=> 'required'
        ]);

        $transaksibarang = SoTransaksiBarang::findOrFail($id);
        $transaksibarang->harga_bm = $request->harga_bm;
        $transaksibarang->quantity_bm = $request->quantity_bm;
        $transaksibarang->update();
        //untuk insert ke gudang
        $save = Gudang::firstOrNew([
            'barang_id' => $transaksibarang->barang_id
        ]);
        $jumlah = $transaksibarang->quantity_bm + $save->jumlah_sebelum;
        $save->jumlah_sebelum = is_null($save->jumlah) ? 0 : $save->jumlah;
        $save->jumlah = $jumlah;
        $save->save();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Harga Barang <strong> $transaksibarang->quantity_bm " . $transaksibarang->barang->satuan->nama_satuan . " " . $transaksibarang->barang->nama_barang . "</strong>"
            ]);
        
        return redirect('barang-masuk/' . $transaksibarang->so_transaksi_id . '/edit/');
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

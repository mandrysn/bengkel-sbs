<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiBarang;
use App\Barang;
use App\Tagihan;
use App\Permission;
use App\SoTransaksi;
use Auth;
use Session;

class EkstimasiBarangController extends Controller
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
            'barang_diskon' => 'required',
            'barang_harga_transaksi' => 'required',
            'so_transaksi_id' => 'required'
        ]);

        $transaksi_barang = SoTransaksiBarang::findOrFail($id);
        $data_harga = $transaksi_barang->harga_transaksi;
        $data_diskon = $transaksi_barang->diskon;
        $data_quantity = $transaksi_barang->quantity;

        $transaksi = SoTransaksi::findOrFail($request->so_transaksi_id);
        $jumlah_estimasi = $transaksi->jumlah_estimasi;


        $transaksi_barang->harga_transaksi = $request->barang_harga_transaksi;
        $transaksi_barang->diskon = $request->barang_diskon;
        $transaksi_barang->update();

        if (is_null($jumlah_estimasi) ) {
            $transaksi->jumlah_estimasi = ( ( $transaksi_barang->harga_transaksi - ($transaksi_barang->harga_transaksi * $transaksi_barang->diskon / 100) ) * $transaksi_barang->quantity ) - $jumlah_estimasi;
        } else {
            $total = $jumlah_estimasi - ( ( $data_harga - ($data_harga * $data_diskon / 100) ) * $data_quantity ) ;
            $transaksi->jumlah_estimasi = ( ( $transaksi_barang->harga_transaksi - ($transaksi_barang->harga_transaksi * $transaksi_barang->diskon / 100) ) * $transaksi_barang->quantity ) + $total;
        }
        $transaksi->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Estimasi Barang"
            ]);
        
        return redirect('ekstimasi/'. $request->so_transaksi_id .'/edit/');
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
        
        $transaksi = SoTransaksi::findOrFail($data->so_transaksi_id);
        if ($transaksi->jumlah_estimasi > 0) {
            
            $transaksi->jumlah_estimasi = $transaksi->jumlah_estimasi - ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity;
            $transaksi->update();
            
        }
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data"
            ]);
        
        return redirect('ekstimasi/'. $data->so_transaksi_id .'/edit/');
    }
}

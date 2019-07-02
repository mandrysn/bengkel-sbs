<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksiJasa;
use App\Tagihan;
use App\Permission;
use App\SoTransaksi;
use Auth;
use Session;

class EkstimasiJasaController extends Controller
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
        // foreach ($request->get('jasa', []) as $jasa) {
        //     SoTransaksiJasa::where('id', $jasa['id'])
        //                 ->update(array_except($jasa, ['harga_transakasi']));
        // }

        $this->validate($request, [
            'jasa_diskon' => 'required',
            'jasa_harga_transaksi' => 'required',
            'so_transaksi_id' => 'required'
        ]);

        $transaksi_jasa = SoTransaksiJasa::findOrFail($id);
        $data_harga = $transaksi_jasa->harga_transaksi;
        $data_diskon = $transaksi_jasa->diskon;
        $data_quantity = $transaksi_jasa->quantity;

        $transaksi = SoTransaksi::findOrFail($request->so_transaksi_id);
        $jumlah_estimasi = $transaksi->jumlah_estimasi;
        

        $transaksi_jasa->harga_transaksi = $request->jasa_harga_transaksi;
        $transaksi_jasa->diskon = $request->jasa_diskon;
        $transaksi_jasa->update();

        if (is_null($jumlah_estimasi) ) {
            $transaksi->jumlah_estimasi = ( ( $transaksi_jasa->harga_transaksi - ($transaksi_jasa->harga_transaksi * $transaksi_jasa->diskon / 100) ) * $transaksi_jasa->quantity ) - $jumlah_estimasi;
        } else {
            $total = $jumlah_estimasi - ( ( $data_harga - ($data_harga * $data_diskon / 100) ) * $data_quantity ) ;
            $transaksi->jumlah_estimasi = ( ( $transaksi_jasa->harga_transaksi - ($transaksi_jasa->harga_transaksi * $transaksi_jasa->diskon / 100) ) * $transaksi_jasa->quantity ) + $total;
        }
        $transaksi->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Estimasi Jasa "
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

        $data = SoTransaksiJasa::findOrFail($id);
        $transaksi = SoTransaksi::findOrFail($data->so_transaksi_id);
        if ($transaksi->jumlah_estimasi > 0) {
        $transaksi->jumlah_estimasi = $transaksi->jumlah_estimasi - ( ($data->harga_transaksi * $data->quantity) - ($data->diskon / 100) ) ;
        $transaksi->update();
        }
        $data->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data"
            ]);
        
        return redirect('ekstimasi/'. $data->so_transaksi_id .'/edit/');
    }
}
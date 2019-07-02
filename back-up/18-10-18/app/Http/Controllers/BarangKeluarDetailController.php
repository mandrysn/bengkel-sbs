<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use App\BarangMasukDetail;
use App\Gudang;
use App\Permission;
use Auth;
use Session;

class BarangKeluarDetailController extends Controller
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
        //
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

        $data = BarangKeluarDetail::findOrFail($id);
        $data->delete();

        $gudang = Gudang::firstOrNew([
            'barang_id' => $data->barang_id,
            'suplier_id' => $data->suplier_id
        ]);
        $gudang->jumlah -= $data->bk_quantity;
        $gudang->save();

        $bbm = BarangMasukDetail::findOrFail($data->barang_masuk_detail_id);
        $bbm->bm_quantity += $data->bk_quantity;
        $bbm->update();
        
        $transaksi = BarangKeluar::findOrFail($data->barang_keluar_id);
        if ($transaksi->total > 0) {
            
            $transaksi->total -= ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bk_quantity;
            $transaksi->update();
            
        }

        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data"
            ]);
        
        return redirect('barang-keluar/'. $data->barang_keluar_id .'/edit/');
    }
}

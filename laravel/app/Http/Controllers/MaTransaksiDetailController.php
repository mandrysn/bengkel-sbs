<?php

namespace App\Http\Controllers;

use App\SoTransaksiBarang;
use App\PoTransaksiBarang;
use Session;
use App\Permission;
use App\MaterialBarang;
use App\Material;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaTransaksiDetail  $maTransaksiDetail
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

        $data = MaterialBarang::findOrFail($id);
        $data->delete();

        $transaksi = Material::findOrFail($data->material_id);
        if ($transaksi->total > 0) {

            $transaksi->total -= ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->ma_quantity;
            $transaksi->update();

        }

        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Pemesanan Barang"
            ]);
        
        return redirect('order-material/'. $data->material_id .'/edit/');
    }
}

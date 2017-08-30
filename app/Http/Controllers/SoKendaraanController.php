<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\SoPelanggan;
use App\SoKendaraan;

class SoKendaraanController extends Controller
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
        $this->validate($request, [
            'no_claim'        => 'required',
            'no_polisi'       => 'required|max:10',
            'no_rangka'       => 'required|max:17',
            'no_mesin'        => 'required|max:15',
            'merek_kendaraan' => 'required',
            'type_kendaraan'  => 'required',
            'warna_kendaraan' => 'required',
            'tahun_kendaraan' => 'required|max:4',
            'km_kendaraan'    => 'required|max:9',
//            'foto_depan'      => 'required',
//            'foto_belakang'   => 'required',
//            'foto_kanan'      => 'required',
//            'foto_kiri'       => 'required',
            'tanggal_masuk'   => 'required',
            'tanggal_selesai' => 'required'
        ]);
        
        SoKendaraan::create([
            'no_polisi'       => $request->no_polisi,
            'no_rangka'       => $request->no_rangka,
            'no_mesin'        => $request->no_mesin,
            'merek_kendaraan' => $request->merek_kendaraan,
            'type_kendaraan'  => $request->type_kendaraan,
            'warna_kendaraan' => $request->warna_kendaraan,
            'tahun_kendaraan' => $request->tahun_kendaraan,
            'km_kendaraan'    => $request->km_kendaraan,
            'foto_depan'      => 'depan.jpg',
            'foto_belakang'   => 'belakang.jpg',
            'foto_kanan'      => 'kanan.jpg',
            'foto_kiri'       => 'kiri.jpg',
            'tanggal_masuk'   => $request->tanggal_masuk,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
        
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data suplier <strong>$request->no_claim</strong>"
        ]);

        return redirect('servis-order/create#transaksi');
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
        //
    }
}

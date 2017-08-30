<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SoPelanggan;
use App\Asuransi;
use App\Merek;
use Session;

class SoPelangganController extends Controller
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
        $title     = 'Tambah Servis Order';
        $asuransi  = Asuransi::pluck('nama_asuransi', 'id')->all();
        
        return view('pelanggan-order.create', compact('title', 'asuransi'));
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
//        return $request->asuransi_id . $request->no_claim . $request->nama_pelanggan . $request->alamat_pelanggan . $request->no_telpon_pelanggan;
        $this->validate($request, [
            'asuransi_id'    => 'required',
            'no_claim'       => 'required|unique:so_pelanggans',
            'nama_pelanggan' => 'required',
            'no_telpon_pelanggan' => 'required',
            'alamat_pelanggan'    => 'required'
        ]);
        
        $data = SoPelanggan::create([
            'asuransi_id'         => $request->asuransi_id,
            'no_claim'            => $request->no_claim,
            'nama_pelanggan'      => $request->nama_pelanggan,
            'alamat_pelanggan'    => $request->alamat_pelanggan,
            'no_telpon_pelanggan' => $request->no_telpon_pelanggan
        ]);
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data suplier <strong>$request->no_claim</strong>"
        ]);

        return redirect('kendaraan-order/'. $data->id .'/edit/');

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
        //
    }
}

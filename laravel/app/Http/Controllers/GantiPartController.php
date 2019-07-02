<?php

namespace App\Http\Controllers;

use App\GantiPart;
use Auth;
use PDF;
use Session;
use App\Permission;
use Illuminate\Http\Request;

class GantiPartController extends Controller
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
        $this->validate($request, [
            'keterangan_ganti' => 'required'
        ]);
        
        GantiPart::firstOrCreate([
            'so_transaksi_id' => $request->so_transaksi_id,
            'keterangan_ganti' => $request->keterangan_ganti
        ]);

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menambah detail Pergantian"
        ]);

        return redirect('servis-order/'. $request->so_transaksi_id .'/edit/');
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
        $d = GantiPart::findOrFail($id);
        $d->delete();

        return redirect('servis-order/'. $d->so_transaksi_id .'/edit/');
    }
}

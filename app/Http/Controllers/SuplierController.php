<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suplier;
use Session;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title   = 'Supplier';
        $route   = 'suplier';
        $suplier = Suplier::orderby('created_at', 'desc')->paginate(20);
        
        return view('suplier.index', compact('title', 'suplier', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title  = 'Tambah Supplier';
        $button = 'Tambah';
        $route  = 'suplier';
        
        $cari   = Suplier::get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode   = 'SP' . sprintf("%03s", $add);
        
        return view('template.create', compact('title', 'button', 'kode', 'route'));
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
            'nama_suplier'      => 'required',
            'alamat_suplier'    => 'required',
            'no_telpon_suplier' => 'required',
            'kode_suplier'      => 'required|unique:supliers'
        ]);

        Suplier::firstOrCreate([
            'nama_suplier'      => $request->nama_suplier,
            'kode_suplier'      => $request->kode_suplier,
            'alamat_suplier'    => $request->alamat_suplier,
            'no_telpon_suplier' => $request->no_telpon_suplier,
            'no_hp_suplier'     => $request->no_hp_suplier
        ]);
        
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data suplier <strong>$request->kode_suplier, $request->nama_suplier</strong>"
        ]);

        return \Redirect::route('suplier.index');

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
        $route      = 'suplier';
        $controller = 'SuplierController';
        $title      = 'Ubah Suplier';
        $button     = 'Perbarui';
        $data       = Suplier::findOrFail($id);
        $kode       = $data->kode_suplier;
        
        return view('template.edit', compact('title', 'data', 'kode', 'button', 'route', 'controller'));
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
            'nama_suplier'      => 'required',
            'alamat_suplier'    => 'required',
            'no_telpon_suplier' => 'required',
            'kode_suplier'      => 'required|unique:supliers,kode_suplier,'.$id,
        ]);

        $suplier = Suplier::findOrFail($id);
        $suplier->nama_suplier      = $request->nama_suplier;
        $suplier->alamat_suplier    = $request->alamat_suplier;
        $suplier->kode_suplier      = $request->kode_suplier;
        $suplier->no_telpon_suplier = $request->no_telpon_suplier;
        $suplier->no_hp_suplier     = $request->no_hp_suplier;
        $suplier->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data suplier <strong>$request->kode_suplier, $request->nama_suplier</strong>"
            ]);
        
        return \Redirect::route('suplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Suplier::findOrFail($id);
        $data->delete();
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->kode_suplier, $data->nama_suplier</strong>"
            ]);
        
        return \Redirect::route('suplier.index');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request)
    {
        $kata_kunci = $request->kata_kunci;
        $title = 'Supplier - Pencarian ' . $kata_kunci;
        $route = 'suplier';
        
        $suplier = Suplier::where('nama_suplier', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('unit_suplier', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('kode_suplier', 'LIKE', '%' . $kata_kunci . '%')
                      ->orderBy('kode_suplier', 'asc')
                      ->paginate(20);

        return view('suplier.index', compact('title', 'suplier', 'route'));
    }
}

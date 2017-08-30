<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title  = 'Satuan';
        $route  = 'satuan';
        $satuan = Satuan::orderby('nama_satuan', 'asc')->paginate(5);
        
        return view('satuan.index', compact('title', 'satuan', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = 'Tambah Satuan';
        $button = 'Tambah';
        $route  = 'satuan';
        
        return view('template.create', compact('title', 'button', 'route', 'controller'));
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
            'nama_satuan' => 'required',
            'kode_satuan' => 'required|max:3|unique:satuans'
        ]);

        Satuan::firstOrCreate([
            'kode_satuan' => $request->kode_satuan,
            'nama_satuan' => $request->nama_satuan
        ]);
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data satuan <strong>$request->kode_satuan</strong>"
        ]);

        return \Redirect::route('satuan.index');

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
        $route      = 'satuan';
        $controller = 'SatuanController';
        $title      = 'Ubah Satuan';
        $button     = 'Perbarui';
        $data       = Satuan::findOrFail($id);
        
        return view('template.edit', compact('title', 'data', 'button', 'route', 'controller'));
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
            'nama_satuan' => 'required',
            'kode_satuan' => 'required|unique:satuans,kode_satuan,'.$id,
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->nama_satuan = $request->nama_satuan;
        $satuan->kode_satuan = $request->kode_satuan;
        $asuransi->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data satuan <strong>$request->kode_satuan</strong>"
            ]);
        
        return \Redirect::route('satuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Satuan::findOrFail($id);
        $data->delete();
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->kode_satuan</strong>"
            ]);
        
        return \Redirect::route('satuan.index');
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
        $title = 'Satuan - Pencarian ' . $kata_kunci;
        $route = 'satuan';
        
        $satuan = Satuan::where('nama_satuan', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('kode_satuan', 'LIKE', '%' . $kata_kunci . '%')
                      ->orderBy('kode_satuan', 'asc')
                      ->paginate(10);
                      
        return view('satuan.index', compact('title', 'satuan', 'route'));
    }

}

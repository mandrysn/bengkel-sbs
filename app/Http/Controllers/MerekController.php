<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Merek;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Merek';
        $route = 'merek';
        $merek = Merek::orderby('kode_merek', 'asc')->paginate(20);
        
        return view('merek.index', compact('title', 'merek', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = 'Tambah Merek';
        $button = 'Tambah';
        $route  = 'merek';

        $cari   = Merek::get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'M' . sprintf("%04s", $add);
        
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
            'nama_merek' => 'required',
            'unit_merek' => 'required|unique:mereks',
            'kode_merek' => 'required|unique:mereks'
        ]);
        
        $merek = Merek::firstOrCreate([
            'kode_merek' => $request->kode_merek,
            'nama_merek' => $request->nama_merek,
            'unit_merek' => $request->unit_merek
        ]);
        
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data merek <strong>$merek->kode_merek, $merek->unit_merek</strong>"
        ]);

        return \Redirect::route('merek.index');
        
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
        $route      = 'merek';
        $controller = 'MerekController';
        $title      = 'Ubah Merek';
        $button     = 'Perbarui';
            
        $data       = Merek::findOrFail($id);
        $kode       = $data->kode_merek;
        
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
            'nama_merek' => 'required',
            'unit_merek' => 'required|unique:mereks,unit_merek,'.$id,
            'kode_merek' => 'required|unique:mereks,kode_merek,'.$id,
        ]);
        
        $merek = Merek::findOrFail($id);
        $merek->nama_merek = $request->nama_merek;
        $merek->unit_merek = $request->unit_merek;
        $merek->kode_merek = $request->kode_merek;
        $merek->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data merek <strong>$request->kode_merek, $request->unit_merek</strong>"
            ]);
        
        return \Redirect::route('merek.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $data = Merek::findOrFail($id);
        
        $data->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->kode_merek, $data->nama_merek</strong>"
            ]);
        
        return \Redirect::route('merek.index');
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
        $title = 'Merek - Pencarian ' . $kata_kunci;
        $route = 'merek';
        
        $merek = Merek::where('nama_merek', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('unit_merek', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('kode_merek', 'LIKE', '%' . $kata_kunci . '%')
                      ->orderBy('kode_merek', 'asc')
                      ->paginate(20);

        return view('merek.index', compact('title', 'merek', 'route'));
    }
}

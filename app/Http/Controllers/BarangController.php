<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Merek;
use App\Satuan;
use Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title  = 'Barang';
        $route  = 'barang';
        
        $barang = Barang::orderby('kode_barang', 'asc')->paginate(20);
        
        return view('barang.index', compact('title', 'barang', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title       = 'Tambah Barang';
        $button      = 'Tambah';
        $route       = 'barang';
        
        $result      = Merek::orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        $cari   = Barang::get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode   = 'B' . sprintf("%04s", $add);
        
        $satuan = Satuan::pluck('nama_satuan', 'id')->all();
        
        return view('template.create', compact('title', 'button', 'satuan', 'merek', 'bid', 'kode', 'route'));
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
            'nama_barang'      => 'required',
            'no_part_barang'   => 'required',
            'kategori_barang'  => 'required',
            'merek_id'         => 'required',
            'harga_barang'     => 'required',
            'kode_barang'      => 'required|unique:barangs',
            'satuan_id'        => 'required'
        ]);

        Barang::firstOrCreate([
            'kode_barang'      => $request->kode_barang,
            'nama_barang'      => $request->nama_barang,
            'no_part_barang'   => $request->no_part_barang,
            'kategori_barang'  => $request->kategori_barang,
            'merek_id'         => $request->merek_id,
            'harga_barang'     => $request->harga_barang,
            'satuan_id'        => $request->satuan_id,
            'keterangan'       => $request->keterangan
        ]);
        
        
        Session::flash(
            "flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data barang <strong> $request->nama_barang</strong>"
        ]);

        return \Redirect::route('barang.index');
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
        
        $route      = 'barang';
        $controller = 'BarangController';
        $title      = 'Ubah Barang';
        $button     = 'Perbarui';
        
        $result      = Merek::orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        $data = Barang::findOrFail($id);
        $kode = $data->kode_barang;
        
        $satuan = Satuan::pluck('nama_satuan', 'id')->all();
        
        return view('template.edit', compact('title', 'data', 'button', 'kode', 'merek', 'satuan', 'route', 'controller'));
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
            'kode_barang'      => 'required|unique:barangs,kode_barang,'.$id,
            'nama_barang'      => 'required',
            'no_part_barang'   => 'required',
            'kategori_barang'  => 'required',
            'merek_id'         => 'required',
            'harga_barang'     => 'required',
            'satuan_id'        => 'required'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama_barang     = $request->nama_barang;
        $barang->kode_barang     = $request->kode_barang;
        $barang->no_part_barang  = $request->no_part_barang;
        $barang->kategori_barang = $request->kategori_barang;
        $barang->merek_id        = $request->merek_id;
        $barang->harga_barang    = $request->harga_barang;
        $barang->satuan_id       = $request->satuan_id;
        $barang->keterangan      = $request->keterangan;
        $barang->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data suplier <strong>$request->kode_barang, $request->nama_barang</strong>"
            ]);
        
        return \Redirect::route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Barang::findOrFail($id);
        $data->delete();
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data Barang <strong>$data->kode_barang, $data->nama_barang</strong>"
            ]);
        
        return \Redirect::route('barang.index');
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
         $title = 'Barang - Pencarian ' . $kata_kunci;
         $route = 'barang';
         
         $barang = Barang::where('nama_barang', 'LIKE', '%' . $kata_kunci . '%')
                       ->orWhere('kode_barang', 'LIKE', '%' . $kata_kunci . '%')
                       ->orWhere('no_part_barang', 'LIKE', '%' . $kata_kunci . '%')
                       ->orderBy('kode_barang', 'asc')
                       ->paginate(20);
 
         return view('barang.index', compact('title', 'barang', 'route'));
     }
}

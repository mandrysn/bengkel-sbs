<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Merek;
use App\Satuan;
use App\Permission;
use Auth;
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
        $modul_id = 1;
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

        $title  = 'Barang';
        $route  = 'barang';
        $cari   = 'cari-barang';
        
        $barang = Barang::where('deleted', 'N')->orderby('kode_barang', 'asc')->paginate(25);
        
        return view($route . '.index', compact('title', 'cari', 'barang', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modul_id = 2;
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

        $title       = 'Tambah Barang';
        $button      = 'Tambah';
        $route       = 'barang';
        
        $result      = Merek::where('deleted', 'N')->orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        $satuan = Satuan::pluck('nama_satuan', 'id')->all();
        
        return view('template.create', compact('title', 'button', 'satuan', 'merek', 'bid', 'route'));
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
            'harga_beli'       => 'required',
            'harga_jual'       => 'required',
            'kode_barang'      => 'required|unique:barangs',
            'satuan_id'        => 'required'
        ]);

        Barang::firstOrCreate([
            'kode_barang'      => $request->kode_barang,
            'nama_barang'      => $request->nama_barang,
            'no_part_barang'   => $request->no_part_barang,
            'kategori_barang'  => $request->kategori_barang,
            'merek_id'         => $request->merek_id,
            'harga_beli'       => $request->harga_beli,
            'harga_jual'       => $request->harga_jual,
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
        $modul_id = 3;
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modul_id = 4;
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
        
        $route      = 'barang';
        $controller = 'BarangController';
        $title      = 'Ubah Barang';
        $button     = 'Perbarui';
        
        $result      = Merek::where('deleted', 'N')->orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        $satuan = Satuan::where('deleted', 'N')->pluck('nama_satuan', 'id')->all();
        $data = Barang::findOrFail($id);
        
        return view('template.edit', compact('title', 'data', 'button', 'merek', 'satuan', 'route', 'controller'));
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
            'harga_beli'     => 'required',
            'harga_jual'     => 'required',
            'satuan_id'        => 'required'
        ]);


        // return $request->kategori_barang;W

        $barang = Barang::findOrFail($id);
        $barang->nama_barang     = $request->nama_barang;
        $barang->kode_barang     = $request->kode_barang;
        $barang->no_part_barang  = $request->no_part_barang;
        $barang->kategori_barang = $request->kategori_barang;
        
        if ( ! empty($request->merek_id ) ) {
            $barang->merek_id        = $request->merek_id;
        }
        
        $barang->harga_beli    = $request->harga_beli;
        $barang->harga_jual    = $request->harga_jual;
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

        $data = Barang::findOrFail($id);
        $data->deleted = 'Y';
        $data->update();

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
        //
    }
}

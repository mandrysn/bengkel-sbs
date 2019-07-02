<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suplier;
use Session;
use App\Permission;
use Auth;

class SuplierController extends Controller
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

        $title   = 'Supplier';
        $route   = 'suplier';
        $cari    = 'cari-suplier';
        $suplier = Suplier::where('deleted', 'N')->orderby('created_at', 'desc')->paginate(20);
        
        return view($route . '.index', compact('title', 'suplier', 'cari', 'route'));
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

        $title  = 'Tambah Supplier';
        $button = 'Tambah';
        $route  = 'suplier';
        
        
        return view('template.create', compact('title', 'button', 'route'));
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

        $route      = 'suplier';
        $controller = 'SuplierController';
        $title      = 'Ubah Suplier';
        $button     = 'Perbarui';
        $data       = Suplier::findOrFail($id);
        
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

        $data = Suplier::findOrFail($id);
        $data->deleted = 'Y';
        $data->update();

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
        //
    }
}

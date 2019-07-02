<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Asuransi;
use App\Permission;
use Auth;

class AsuransiController extends Controller
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

        $title = 'Asuransi';
        $route = 'asuransi';
        $cari  = 'cari-asuransi';
        $asuransi = Asuransi::where('deleted', 'N')->orderby('created_at', 'desc')->paginate(20);
        
        return view('asuransi.index', compact('title', 'asuransi', 'cari', 'route'));
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

        $cari = Asuransi::orderBy('id', 'desc')->get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'AS' . sprintf("%03s", $add);

        $title  = 'Tambah Asuransi';
        $button = 'Tambah';
        $route  = 'asuransi';
              
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
            'nama_asuransi'      => 'required',
            'alamat_asuransi'    => 'required',
            'no_telpon_asuransi' => 'required',
            'kode_asuransi'      => 'required|unique:asuransis'
        ]);

        Asuransi::firstOrCreate([
            'nama_asuransi'      => $request->nama_asuransi,
            'kode_asuransi'      => $request->kode_asuransi,
            'alamat_asuransi'    => $request->alamat_asuransi,
            'no_telpon_asuransi' => $request->no_telpon_asuransi,
            'no_hp_asuransi'     => $request->no_hp_asuransi
        ]);
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data asuransi <strong>$request->kode_asuransi</strong>"
        ]);

        return \Redirect::route('asuransi.index');

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

        $route      = 'asuransi';
        $controller = 'AsuransiController';
        $title      = 'Ubah Asuransi';
        $button     = 'Perbarui';
        
        $data   = Asuransi::findOrFail($id);
        $kode   = $data->kode_asuransi;
        
        return view('template.edit', compact('title', 'data', 'button', 'kode', 'route', 'controller'));
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
            'nama_asuransi'      => 'required',
            'alamat_asuransi'    => 'required',
            'no_telpon_asuransi' => 'required',
            'kode_asuransi'      => 'required|unique:asuransis,kode_asuransi,'.$id,
        ]);

        $asuransi = Asuransi::findOrFail($id);
        $asuransi->nama_asuransi      = $request->nama_asuransi;
        $asuransi->alamat_asuransi    = $request->alamat_asuransi;
        $asuransi->kode_asuransi      = $request->kode_asuransi;
        $asuransi->no_telpon_asuransi = $request->no_telpon_asuransi;
        $asuransi->no_hp_asuransi     = $request->no_hp_asuransi;
        $asuransi->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data asuransi <strong>$request->kode_asuransi</strong>"
            ]);
        
        return \Redirect::route('asuransi.index');
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

        $data = Asuransi::findOrFail($id);
        $data->deleted = 'Y';
        $data->update();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->kode_asuransi, $data->nama_asuransi</strong>"
            ]);
        
        return \Redirect::route('asuransi.index');
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

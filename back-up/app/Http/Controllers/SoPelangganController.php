<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SoPelanggan;
use App\SoKendaraan;
use App\Asuransi;
use Session;
use App\Permission;
use Auth;

class SoPelangganController extends Controller
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


        $title = 'Pelanggan';
        $route = 'pelanggan';
        $pelanggan = SoPelanggan::where('deleted', 'N')->orderby('nama_pelanggan', 'asc')->paginate(30);
        
        return view($route . '.index', compact('title', 'pelanggan', 'route'));
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

        $title  = 'Tambah Pelanggan';
        $button = 'Tambah';
        $route  = 'pelanggan';

        $asuransi  = Asuransi::where('deleted', 'N')->pluck('nama_asuransi', 'id')->all();
        
        return view('template.create', compact('title', 'asuransi', 'route', 'button'));
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
            'no_claim' => 'required|unique:so_pelanggans',
            'nama_pelanggan' => 'required|unique:so_pelanggans',
            'alamat_pelanggan' => 'required',
            'no_telpon_pelanggan' => 'required'
        ]);
        
        $pelanggan = SoPelanggan::firstOrCreate([
            'no_claim' => $request->no_claim,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'no_telpon_pelanggan' => $request->no_telpon_pelanggan,
            'asuransi_id' => $request->asuransi_id
        ]);
        
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data Pelanggan <strong>$pelanggan->nama_pelanggan, $pelanggan->no_claim</strong>"
        ]);

        return \Redirect::route('pelanggan.index');
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

        $route      = 'pelanggan';
        $controller = 'SoPelangganController';
        $title      = 'Ubah Data Pelanggan';
        $button     = 'Perbarui';
            
        $data = SoPelanggan::findOrFail($id);
        $asuransi  = Asuransi::where('deleted', 'N')->pluck('nama_asuransi', 'id')->all();
        
        return view('template.edit', compact('title', 'data', 'button', 'route', 'asuransi', 'controller'));
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
            'asuransi_id'    => 'required',
            'nama_pelanggan' => 'required',
            'no_telpon_pelanggan' => 'required',
            'alamat_pelanggan'    => 'required',
            'no_claim'        => 'required',
        ]);
        
        $pelanggan = SoPelanggan::findOrFail($id);
        $pelanggan->asuransi_id         = $request->asuransi_id;
        $pelanggan->no_claim            = $request->no_claim;
        $pelanggan->nama_pelanggan      = $request->nama_pelanggan;
        $pelanggan->alamat_pelanggan    = $request->alamat_pelanggan;
        $pelanggan->no_telpon_pelanggan = $request->no_telpon_pelanggan;
        $pelanggan->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data Pelanggan <strong>" . $pelanggan->nama_pelanggan . "</strong>"
            ]);
        
        return \Redirect::route('pelanggan.index');
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

        $data = SoPelanggan::findOrFail($id);
        $data->deleted = 'Y';
        $data->update();

        $kendaraans = SoKendaraan::where('so_pelanggan_id', $data->id)->get();
        foreach ($kendaraans as $kendaraan) {
            $kendaraan->deleted = 'Y';
            $kendaraan->update();
        }
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data Pelanggan <strong>$data->nama_pelanggan, $data->no_claim</strong>"
            ]);
        
        return \Redirect::route('pelanggan.index');
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
        $title = 'Pelanggan - Pencarian ' . $kata_kunci;
        $route = 'pelanggan';
        
        $pelanggan = SoPelanggan::where('deleted', 'N')
                            ->where('nama_pelanggan', 'LIKE', '%' . $kata_kunci . '%')
                            ->orWhere('no_claim', 'LIKE', '%' . $kata_kunci . '%')
                            ->orderBy('nama_pelanggan', 'asc')
                            ->paginate(20);

        return view($route . '.index', compact('title', 'pelanggan', 'route'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Asuransi;
use App\SoTransaksi;
use App\SoPelanggan;
use App\SoKendaraan;
use App\Permission;
use App\Merek;

class SoKendaraanController extends Controller
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


        $title = 'Kendaraan';
        $route = 'kendaraan';
        $kendaraan = SoKendaraan::where('deleted', 'N')->orderby('id', 'asc')->paginate(30);
        
        return view($route . '.index', compact('title', 'kendaraan', 'route'));
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

        $title  = 'Tambah Kendaraan';
        $button = 'Tambah';
        $route  = 'kendaraan';

        $pelanggan  = SoPelanggan::where('deleted', 'N')->pluck('nama_pelanggan', 'id')->all();
        $result      = Merek::where('deleted', 'N')->orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        return view('template.create', compact('title', 'merek', 'pelanggan', 'route', 'button'));
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
            'so_pelanggan_id' => 'required',
            'no_polisi'       => 'required|max:12|unique:so_kendaraans',
            'no_rangka'       => 'required|max:35',
            'no_mesin'        => 'required|max:35',
            'merek_id'        => 'required',
            'warna_kendaraan' => 'required',
            'tahun_kendaraan' => 'required|max:4',
            'km_kendaraan'    => 'required|max:10',
            'foto_depan'      => 'image|mimes:jpeg,jpg,png'
        ]);

        if ( $request->hasFile('foto_depan') ) {
            $gambar_depan    = $request->file('foto_depan');
            $ext_depan    = $gambar_depan->getClientOriginalExtension();
            
            if ( $request->file('foto_depan')->isValid() ) {
                $gambar_depan_name = "SO_kendaraan_" . $request->km_kendaraan . date('YmdHis') . ".$ext_depan";
                $path_depan = 'asset/order/depan';
                $request->file('foto_depan')->move($path_depan, $gambar_depan_name);
            }
        } else {
            $gambar_depan_name = '-';
        }

        $kendaraan = SoKendaraan::firstOrCreate([
            'so_pelanggan_id' => $request->so_pelanggan_id,
            'no_polisi'       => $request->no_polisi,
            'no_rangka'       => $request->no_rangka,
            'no_mesin'        => $request->no_mesin,
            'merek_id'        => $request->merek_id,
            'warna_kendaraan' => $request->warna_kendaraan,
            'tahun_kendaraan' => $request->tahun_kendaraan,
            'km_kendaraan'    => $request->km_kendaraan,
            'foto_depan'      => $gambar_depan_name
        ]);
        
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data Pelanggan <strong> " .$kendaraan->sopelanggan->nama_pelanggan. "</strong>"
        ]);

        return \Redirect::route('kendaraan.index');
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

        $route      = 'kendaraan';
        $controller = 'SoKendaraanController';
        $title      = 'Ubah Data Kendaraan';
        $button     = 'Perbarui';
            
        $data = SoKendaraan::where('deleted', 'N')->where('id', $id)->first();
        $result      = Merek::where('deleted', 'N')->orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        return view('kendaraan-order.form', compact('title', 'data', 'button', 'route', 'merek', 'controller'));
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
            'no_polisi'       => 'required|max:12',
            'no_rangka'       => 'required|max:17',
            'no_mesin'        => 'required|max:15',
            'merek_id'        => 'required',
            'warna_kendaraan' => 'required',
            'tahun_kendaraan' => 'required|max:4',
            'km_kendaraan'    => 'required|max:9',
            'foto_kendaraan'  => 'image|mimes:jpeg,jpg,png'
        ]);

        $kendaraan = SoKendaraan::where('deleted', 'N')->where('id', $id)->first();
        
        if ( $request->hasFile('foto_depan') ) {

            $exists_f  = Storage::disk('foto_depan')->exists($kendaraan->foto_depan);

            if (isset($kendaraan->foto_depan) && $exists_f ) {
                Storage::disk('foto_depan')->delete($kendaraan->foto_depan);
                   
            }

            $gambar_depan    = $request->file('foto_depan');
            $ext_depan    = $gambar_depan->getClientOriginalExtension();
            
            if ($request->file('foto_depan')->isValid() ) {
                $gambar_depan_name = "SO_kendaraan_" . $request->km_kendaraan . date('YmdHis') . ".$ext_depan";
                $path_depan = 'asset/order/depan';
                $request->file('foto_depan')->move($path_depan, $gambar_depan_name);
            }

            $kendaraan->foto_depan      = $gambar_depan_name;
        }

        $kendaraan->no_polisi       = $request->no_polisi;
        $kendaraan->no_rangka       = $request->no_rangka;
        $kendaraan->no_mesin        = $request->no_mesin;
        $kendaraan->merek_id        = $request->merek_id;
        $kendaraan->warna_kendaraan = $request->warna_kendaraan;
        $kendaraan->tahun_kendaraan = $request->tahun_kendaraan;
        $kendaraan->km_kendaraan    = $request->km_kendaraan;
        $kendaraan->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data Kendaraan <strong>" .$kendaraan->sopelanggan->nama_pelanggan. "</strong>"
            ]);
        
        return \Redirect::route('kendaraan.index');
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

        $data = SoKendaraan::findOrFail($id);
        $data->deleted = 'Y';
        $data->update();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data Kendaraan <strong>$data->no_polisi, ".$data->sopelanggan->nama_pelanggan. "</strong>"
            ]);
        
        return \Redirect::route('kendaraan.index');
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
        $title = 'Kendaraan - Pencarian ' . $kata_kunci;
        $route = 'kendaraan';
        
        $kendaraan = SoKendaraan::where('deleted', 'N')
                      ->where('no_polisi', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('no_rangka', 'LIKE', '%' . $kata_kunci . '%')
                      ->orWhere('no_mesin', 'LIKE', '%' . $kata_kunci . '%')
                      ->orderBy('id', 'asc')
                      ->paginate(20);

        return view($route.'.index', compact('title', 'kendaraan', 'route'));
    }
}
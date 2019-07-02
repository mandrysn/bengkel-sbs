<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SoKendaraan;
use App\SoTransaksi;
use Session;
use App\Permission;
use App\SoDetail;
use App\PreSoHst;
use Auth;
use PDF;

class PreSoController extends Controller
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

        $title = 'Pre Servis Order';
        $route = 'pre-so';
        
        $sot = SoTransaksi::where('status', 1)->orderby('created_at', 'asc')->paginate(20);
        
        return view($route.'.index', compact('title', 'sot', 'route'));
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

        $title     = 'Tambah Pre Servis Order';
        $button    = 'Tambah';
        $route     = 'pre-so';

        $cari = PreSoHst::count();
        if ( $cari < 1 ) {
            $add = 1;
        } else if ($cari >= 1) {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-PreSO' . sprintf("%04s", $add);

        $result      = SoKendaraan::where('deleted', 'N')->orderBy('id', 'asc')->get();
        $kendaraan   = [];
        foreach ( $result as $v ) {
            if ( !isset($kendaraan[$v->no_polisi]) ) {
                $kendaraan[$v->no_polisi] = [];
            }
            $kendaraan[$v->sopelanggan->nama_pelanggan][$v->id] = $v->no_polisi;
            $pelanggan[$v->sopelanggan->nama_pelanggan][$v->id] = $v->id;
        }

        return view('template.create', compact('title', 'button', 'kode', 'route', 'kendaraan'));
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
            'no_transaksi' => 'required',
            'so_kendaraan_id' => 'required',
            'tanggal_pre' => 'required',
        ]);
        
        $id = SoTransaksi::firstOrCreate([
            'no_transaksi' => $request->no_transaksi,
            'so_kendaraan_id' => $request->so_kendaraan_id,
            'status' => '1', // set as Pre-SO
            'tanggal_pre' => $request->tanggal_pre,
        ]);
        PreSoHst::create(['no_transaksi' => $request->no_transaksi]);
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menambah transaksi Pre Servis Order"
        ]);
        
        return redirect('pre-so/'. $id->id .'/edit/');
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

        $transaksi = SoTransaksi::findOrFail($id);
        $pres = SoDetail::where('status', '0')->where('so_transaksi_id', $id)->get();
        $title     = 'Detail: No. ' . $transaksi->no_transaksi;
        $route     = 'pre-so';
        
        return view($route.'.show', compact('title', 'route', 'transaksi', 'pres'));
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

        $title     = 'Edit Pre Servis Order';
        $button    = 'Tambah';
        $route     = 'pre-so';
        $controller = 'PreSoController';

        $transaksi = SoTransaksi::findOrFail($id);
        $details = SoDetail::where('status', '0')->where('so_transaksi_id', $id)->get();
        
        return view($route.'.edit', compact('title', 'controller', 'route', 'transaksi', 'details', 'button'));
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
            'keluhan'         => 'required',
            'perbaikan'       => 'required'
        ]);
        
        SoDetail::firstOrCreate([
            'so_transaksi_id' => $id,
            'keluhan'         => $request->keluhan,
            'perbaikan'       => $request->perbaikan,
            'keterangan'      => $request->keterangan,
			'status'		  => '0'
        ]);
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menambah detail Keluhan"
        ]);

        return redirect('pre-so/'. $id .'/edit/');
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
        
        $preSo = SoTransaksi::findOrFail($id);
        $preSo->delete();

        return \Redirect::route('pre-so.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        $transaksi = SoTransaksi::findOrFail($id);
        $details = SoDetail::where('status', '0')->where('so_transaksi_id', $id)->get();
        $title     = 'Pre Servis Order No. ' . $transaksi->no_transaksi;
        
        $pdf = PDF::loadview('pre-so.print', compact('transaksi', 'details', 'title'));
        // return view('pre-so.print');
        return $pdf->setPaper('f4')->download('Pre-SO-'.$transaksi->no_transaksi.'.pdf');
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
        $title = 'Pre Servis Order - Pencarian ' . $kata_kunci;
        $route = 'pre-so';
        
        $sot = SoTransaksi::where('no_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                            ->orderBy('no_transaksi', 'asc')
                            ->paginate(20);

        return view($route . '.index', compact('title', 'sot', 'route'));
    }
}

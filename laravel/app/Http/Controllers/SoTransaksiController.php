<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SoKendaraan;
use App\SoTransaksi;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;
use App\Barang;
use App\SoDetail;
use Session;
use App\Permission;
use App\PreSoHst;
use App\ChangePart;
use Auth;
use PDF;

class SoTransaksiController extends Controller
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

        $title = 'Surat Perintah Kerja';
        $route = 'servis-order';
        $cari = 'cari-so';
        
        $sot = SoTransaksi::where('status', 2)->where('no_transaksi', 'LIKE', '%-SO%')->orderby('id', 'desc')->paginate(20);
        
        return view('servis-order.index', compact('title', 'sot', 'cari', 'route'));
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

        $title     = 'Tambah Surat Perintah Kerja';
        $button    = 'Tambah';
        $route     = 'servis-order';


        $cari = SoTransaksi::where('no_transaksi', 'LIKE', '%SBS' . date('Y') . '-SO%')->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-SO' . sprintf("%04s", $add);
        
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
            'id'      => 'required',
            'no_transaksi' => 'required',
            'tanggal_so' => 'required'
        ]);
        
        $transaksi = SoTransaksi::findOrFail($request->id);
        $transaksi->status       = '2';
        $transaksi->no_transaksi = $request->no_transaksi;
        $transaksi->tanggal_so   = $request->tanggal_so;
        $transaksi->tanggal_claim = $request->tanggal_claim;
        $transaksi->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menyetujui Servis Order"
            ]);
        
            return redirect('servis-order/'. $request->id .'/edit/');
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

        $sot   = SoTransaksi::findOrFail($id);
        $pres = SoDetail::where('status', '0')->where('so_transaksi_id', $id)->get();
        $details = SoDetail::where('status', '1')->where('so_transaksi_id', $id)->get();
        $gantis = ChangePart::where('so_transaksi_id', $id)->get();
        
        $title = 'No. ' . $sot->no_transaksi;
        $route = 'servis-order';
        
        return view($route . '.show', compact('title', 'sot', 'pres', 'route', 'gantis', 'details'));
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

        $title     = 'Edit Surat Perintah Kerja';
        $button    = 'Tambah';
        $route     = 'servis-order';
        $controller = 'SoTransaksiController';

        $transaksi = SoTransaksi::findOrFail($id);
        $details = SoDetail::where('so_transaksi_id', $id)->get();
        $pergantians = ChangePart::where('so_transaksi_id', $id)->get();
        
        return view($route.'.edit', compact('title', 'controller', 'route', 'pergantians', 'transaksi', 'details', 'button'));
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
			'status'		  => '1'
        ]);
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menambah detail Keluhan"
        ]);

        return redirect('servis-order/'. $id .'/edit/');
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
        
        $cari = PreSoHst::count();
        if ( $cari < 1 ) {
            $add = 1;
        } else if ($cari >= 1) {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-PreSO' . sprintf("%04s", $add);

        $preSo = SoTransaksi::findOrFail($id);
        $preSo->status = '1';
        $preSo->tanggal_so = NULL;
        $preSo->tanggal_claim = NULL;
        $preSo->no_transaksi = $kode;
        $preSo->update();

        $soDetail = SoDetail::where('so_transaksi_id', $id)->where('status', '1')->get();

        foreach($soDetail as $d) {
            $d = SoDetail::findOrFail($d->id);
            $d->delete();
        }

        $ganti = ChangePart::where('so_transaksi_id', $id)->get();

        foreach($ganti as $g) {
            $g = ChangePart::findOrFail($g->id);
            $g->delete();
        }

        return \Redirect::route('servis-order.index');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cariSpk()
    {
        $sot = SoTransaksi::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('servis-order.cari-spk', compact('sot'));
    }
}

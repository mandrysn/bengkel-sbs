<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use App\Utang;
use App\Operasional;
use App\PengeluaranOperasional;
use App\PengeluaranSuplier;
use Session;
use App\Permission;
use Auth;

class PengeluaranController extends Controller
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

        $title = 'Pengeluaran';
        $route = 'pengeluaran';
        $cari = 'cari-pengeluaran';

        $pengeluaran = Pengeluaran::orderby('tanggal_masuk', 'asc')->paginate(20);
        
        return view('keuangan.pengeluaran.index', compact('title', 'cari', 'pengeluaran', 'route'));
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

        $route   = 'pengeluaran';
        $title   = 'Tambah Data Pengeluaran';
        
        $cari   = Pengeluaran::where('no_transaksi', 'LIKE', '%SBS' . date('Y') . '-PEN%')->orderby('id', 'desc')->get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $noma = 'SBS' . date('Y') . '-PEN' . sprintf("%04s", $add);

        $utang = Utang::where('sisa', '>', 0)->get();
        $operasional = Operasional::where('deleted', 'N')->pluck('nama_operasional', 'id');
        
        $button  = 'Simpan';
        
        return view('keuangan.pengeluaran.create', compact('title', 'route', 'noma', 'utang', 'button', 'operasional'));
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
            'no_transaksi'   => 'required|unique:pengeluarans',
            'tanggal_masuk'   => 'required',
            'jumlah_bayar'   => 'required'
        ]);


        $pengeluaran = Pengeluaran::firstOrCreate([
            'no_transaksi'  => $request->no_transaksi,
            'tanggal_masuk' => $request->tanggal_masuk,
			'keterangan_transaksi' => $request->keterangan_transaksi,
                'operasional_id' => $request->operasional_id,
                'total_pengeluaran'           => $request->jumlah_bayar
        ]);
        /*$pengeluaran->total_pengeluaran += $request->jumlah_bayar;
        $pengeluaran->save();

        if ( ! empty($request->operasional_id) ) {
            
            $this->validate($request, [
                'operasional_id'   => 'required'
            ]);
            
            PengeluaranOperasional::firstOrCreate([
                'pengeluaran_id'    => $pengeluaran->id,
                'operasional_id' => $request->operasional_id,
                'jumlah_bayar'           => $request->jumlah_bayar
            ]);
            
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, melakukan pembayaran Operasional"
                ]);
        } else if ( ! empty($request->utang_id) ) {
            $this->validate($request, [
                'utang_id'  => 'required'
            ]);
            
            PengeluaranSuplier::firstOrCreate([
                'pengeluaran_id'    => $pengeluaran->id,
                'utang_id' => $request->utang_id,
                'jumlah_bayar'           => $request->jumlah_bayar
            ]);

            $utang = Utang::findOrFail($request->utang_id);
            $utang->sisa -= $request->jumlah_bayar;
            $utang->update();

            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, melakukan pembayaran Utang"
                ]);
        }*/
        Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, melakukan pembayaran"
                ]);
        return \Redirect::route('pengeluaran.index');
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

        $route   = 'pengeluaran';
        $title   = 'Tambah Data Pengeluaran';
        
        $pen   = Pengeluaran::findOrFail($id);

        $utang = Utang::where('sisa', '>', 0)->get();
        $operasional = Operasional::where('deleted', 'N')->pluck('nama_operasional', 'id');

        $op   = PengeluaranOperasional::where('pengeluaran_id', $id)->get();
        $sp   = PengeluaranSuplier::where('pengeluaran_id', $id)->get();
        $csp  = $sp->count();
        $cop  = $op->count();
        
        $button  = 'Perbarui';
        
        return view('keuangan.pengeluaran.edit', compact('title', 'route', 'pen', 'utang', 'button', 'operasional', 'op', 'sp', 'cop', 'csp'));
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
            'jumlah_bayar'   => 'required'
        ]);

        $pengeluaran = Pengeluaran::firstOrNew([
            'no_transaksi'  => $request->no_transaksi
        ]);
        $pengeluaran->total_pengeluaran += $request->jumlah_bayar;
        $pengeluaran->save();

        if ( ! empty($request->operasional_id) ) {
            
            $this->validate($request, [
                'operasional_id'   => 'required'
            ]);
            
            $po = PengeluaranOperasional::firstOrNew([
                'pengeluaran_id'    => $id,
                'operasional_id' => $request->operasional_id
            ]);
            $po->jumlah_bayar += $request->jumlah_bayar;
            $po->save();
            
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, melakukan pembayaran Operasional"
                ]);
        } else if ( ! empty($request->utang_id) ) {
            $this->validate($request, [
                'utang_id'  => 'required'
            ]);
            
            $ps = PengeluaranSuplier::firstOrNew([
                'pengeluaran_id'    => $id,
                'utang_id' => $request->utang_id
            ]);
            $ps->jumlah_bayar           += $request->jumlah_bayar;
            $ps->save();

            $utang = Utang::findOrFail($request->utang_id);
            $utang->sisa -= $request->jumlah_bayar;
            $utang->update();

            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, melakukan pembayaran Utang"
                ]);
        }

        return redirect('pengeluaran/' . $id . '/edit');
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

        $data = Pengeluaran::findOrFail($id);
        $data->delete();
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->no_transaksi</strong>"
            ]);
        
        return \Redirect::route('pengeluaran.index');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Pemasukan;
use App\Tagihan;
use App\Permission;
use App\SoTransaksiBarang;
use App\SoTransaksiJasa;
use App\PreSoHst;
use Auth;

class PemasukanController extends Controller
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

        $title = 'Pemasukan';
        $route = 'pemasukan';
        $cari  = 'cari-pemasukan';
        $pemasukan = Pemasukan::orderby('tanggal_masuk', 'asc')->paginate(20);
        
        return view('keuangan.pemasukan.index', compact('title', 'cari', 'pemasukan', 'route'));
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

        $route   = 'pemasukan';
        $title   = 'Tambah Data Pemasukan';
        
        $cari = PreSoHst::where('no_transaksi', 'LIKE', '%-PEM%')->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $noma = 'SBS' . date('Y') . '-PEM' . sprintf("%04s", $add);
        $button  = 'Simpan';

        $or = Tagihan::whereNotNull('jumlah_or')
							->where('deleted', 'N')
                            ->whereNotExists(function($query) {
                                $query->selectRaw('pemasukans.tagihan_id')
                                    ->from('pemasukans')
                                    ->where('pemasukans.status', '!=', '1')
                                    ->whereRaw('tagihans.id = pemasukans.tagihan_id');
                            })
                            ->orderby('tanggal_masuk', 'asc')
                            ->get();
        
        $tagihan = Tagihan::where('tagihan', '>', '0')
							->where('deleted', 'N')
                            ->whereNotExists(function($query) {
                                $query->selectRaw('pemasukans.tagihan_id')
                                    ->from('pemasukans')
                                    ->where('pemasukans.status', '!=', '2')
                                    ->whereRaw('tagihans.id = pemasukans.tagihan_id');
                            })
                            ->orderby('tanggal_masuk', 'asc')
                            ->get();
        
        return view('keuangan.pemasukan.create', compact('title', 'route', 'noma', 'button', 'or', 'tagihan'));
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
            'no_transaksi'   => 'required|unique:pemasukans',
            'tanggal_masuk'   => 'required'
        ]);
        
        if ( empty($request->jumlah_bayar) ) {
			
			$status = explode('-', $request->tagihan_id);
				$cek = Tagihan::findOrFail($request->tagihan_id);
				
                     $tagihan_id    = $cek->id;
                    $jumlah_bayar = $status[1] == '1' ? $cek->tagihan : $cek->jumlah_or;
                    $status = $status[1];
        } else if ( ! empty($request->jumlah_bayar) ) {
            $tagihan_id    = $request->tagihan_id . '-';
            $jumlah_bayar   = $request->jumlah_bayar;
            $status = '3';
        }
		
        Pemasukan::firstOrCreate([
            'tagihan_id'    => $tagihan_id,
            'keterangan' => $request->keterangan,
            'jumlah_bayar'   => $jumlah_bayar,
            'tanggal_masuk' => $request->tanggal_masuk,
            'no_transaksi' => $request->no_transaksi,
            'status' => $status
        ]);
        PreSoHst::create(['no_transaksi' => $request->no_transaksi]);
        
                Session::flash(
                    "flash_notif", [
                        "level"     => "dismissible alert-info",
                        "message"   => "Berhasil, mengirim Pemasukan"
                    ]);

                return redirect('pemasukan/');
            

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

        $route   = 'pemasukan';
        $title   = 'Tambah Data Pemasukan';
        
        $pem   = Pemasukan::findOrFail($id);
        
        $button  = 'Perbarui';
        
        return view('keuangan.pemasukan.edit', compact('title', 'route', 'pem', 'button'));
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
        
        $pem = Pemasukan::findOrFail($id);
        $pem->keterangan = $request->keterangan;
        $pem->jumlah_bayar = $request->jumlah_bayar;
        $pem->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, mengubah Pemasukan dari Tagihan Nomor <strong>$pem->no_transaksi</strong>"
            ]);

            return redirect('pemasukan/');
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

        $data = Pemasukan::findOrFail($id);
        $data->delete();

        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->no_transaksi</strong>"
            ]);
        
        return \Redirect::route('pemasukan.index');
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
        $title = 'Pemasukan - Pencarian ' . $kata_kunci;
        $route = 'pemasukan';
        
        $pemasukan = Pemasukan::where('no_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                              ->orderBy('tanggal_masuk', 'asc')
                              ->paginate(20);

        return view('keuangan.pemasukan.index', compact('title', 'pemasukan', 'route'));
    }
}

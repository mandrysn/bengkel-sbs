<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoPelanggan;
use App\SoKendaraan;
use App\SoKendaraanAfter;
use App\SoTransaksi;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;
use App\Asuransi;
use App\Barang;
use App\Satuan;
use App\Suplier;
use App\Merek;
use App\Tagihan;
use App\SoDetail;
use App\ProsesJejak;
use App\Permission;
use Auth;
use Session;
use Storage;

class JejakPelangganController extends Controller
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

        $title = 'Status Pelanggan';
        $route = 'jejak-pelanggan';
        $cari  = 'cari-jejak-pelanggan';
        
        $asuransi = Asuransi::pluck('nama_asuransi', 'id')->all();
        $sot   = Tagihan::where('deleted', 'N')->orderby('tanggal_masuk', 'asc')
                            ->paginate(20);

        return view($route . '.index', compact('title', 'cari', 'sot', 'asuransi', 'route'));
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $sot   = Tagihan::findOrFail($id);
        $aft   = SoKendaraanAfter::where('so_transaksi_id', $sot->so_transaksi_id)->first();
        $details = SoDetail::where('so_transaksi_id', $sot->so_transaksi_id)->get();

        $detail_barang   = SoTransaksiBarang::where('so_transaksi_id', $sot->so_transaksi_id)->where('kategori_transaksi', '2')->get();
        $detail_material = SoTransaksiBarang::where('so_transaksi_id', $sot->so_transaksi_id)->where('kategori_transaksi', '1')->get();
        $detail_jasa     = SoTransaksiJasa::where('so_transaksi_id', $sot->so_transaksi_id)->get();
        $count_jasa    = SoTransaksiJasa::where('so_transaksi_id', $sot->so_transaksi_id)->count();
        $count_barang  = SoTransaksiBarang::where('so_transaksi_id', $sot->so_transaksi_id)->where('kategori_transaksi', '2')->count();
        $count_material  = SoTransaksiBarang::where('so_transaksi_id', $sot->so_transaksi_id)->where('kategori_transaksi', '1')->count();

        $jfp   = ProsesJejak::where('so_transaksi_id', $sot->so_transaksi_id)->first();
        if ($jfp != NULL) {
        $foto_proses = $jfp->foto_proses;
        }

        $title = 'Detail: No. ' . $sot->sotransaksi->no_transaksi;
        $route = 'jejak-pelanggan';
        
        return view($route . '.show', compact('title', 'sot', 'details', 'detail_barang', 'detail_jasa', 'detail_material', 'count_material', 'count_jasa', 'count_barang', 'route', 'jfp', 'aft'));
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

        $sot   = Tagihan::findOrFail($id);
        
        $title = 'Detail: No. ' . $sot->sotransaksi->no_transaksi;
        $route = 'jejak-pelanggan';
        $button    = 'Perbarui';
        
        return view($route . '.edit', compact('title', 'sot', 'route', 'button', 'soj'));
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
            'status_pekerjaan' => 'required',
            'status_tagihan' => 'required'
        ]);
        
        $transaksi = Tagihan::findOrFail($id);
        $transaksi->status_pekerjaan = $request->status_pekerjaan;
        $transaksi->status_tagihan = $request->status_tagihan;
        $transaksi->update();

        if ( ! empty($request->foto_depan) ) {
        
            if ($request->hasFile('foto_depan') ) {
                $gambar_depan    = $request->file('foto_depan');
                $ext_depan    = $gambar_depan->getClientOriginalExtension();
                
                if ($request->file('foto_depan')->isValid() ) {
                    $gambar_depan_name = "SO_depan_after" . $transaksi->sotransaksi->sokendaraan->km_kendaraan . date('YmdHis') . ".$ext_depan";
                    $path_depan = 'asset/order/depan';
                    $request->file('foto_depan')->move($path_depan, $gambar_depan_name);
                }
            }

            if ($request->hasFile('foto_proses')) {
                $images = [];
                if($files = $request->file('foto_proses')){
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $name = "proses_" . $transaksi->sotransaksi->sokendaraan->km_kendaraan . ".$extension";
                    $path_proses = 'asset/order/proses';
                    $file->move($path_proses, $name);
                    $images[] = $name;
                }
                $proses = ProsesJejak::firstOrCreate([
                    'so_transaksi_id' => $id,
                    'foto_proses'=>  implode("|",$images)
                ]);
                
                }


            }

            SoKendaraanAfter::firstOrCreate([
                'so_transaksi_id' => $id,
                'foto_depan'      => $gambar_depan_name
            ]);

        }
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil memperbarui gambar"
        ]);

        return redirect('jejak-pelanggan/' . $id);
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

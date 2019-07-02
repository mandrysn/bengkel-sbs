<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\Suplier;
use App\Asuransi;
use App\Barang;
use App\Gudang;
use App\BarangMasuk;
use App\BarangMasukDetail;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use Session;
use App\Permission;
use Auth;
use PDF;

class BarangKeluarController extends Controller
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

        $route  = 'barang-keluar';
        $title  = 'Barang Keluar';
        $order   = BarangKeluar::orderby('tanggal_masuk', 'asc')->paginate(20);

        return view($route.'.index', compact('title', 'order', 'route'));
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

        $route   = 'barang-keluar';
        $title   = 'Tambah Barang Keluar';

        $notransaksi = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')
                                    ->pluck('no_transaksi', 'id')
                                    ->all();

        $cari   = BarangKeluar::where('bbk_transaksi', 'LIKE', '%SBS' . date('Y') . '-BBK%')->orderby('id', 'desc')->get()->count();
        if ($cari < 1 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-BBK' . sprintf("%04s", $add);

        $button  = 'Selanjutnya';

                // return $barang = BarangMasukDetail::pluck('bbm_transaksi', 'id')->all();
                $barang = BarangMasukDetail::where('bm_quantity', '>', 0)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('barang_keluar_details.barang_masuk_detail_id')
                                            ->from('barang_keluar_details')
                                            ->whereRaw('barang_keluar_details.barang_masuk_detail_id = barang_masuk_details.id');
                                    })
                                    ->get();
        
        return view('template.create', compact('title', 'button', 'route', 'notransaksi', 'kode', 'barang'));
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
            'tanggal_masuk' => 'required',
            'bbk_transaksi' => 'required|unique:barang_keluars',
            'id'            => 'required'
        ]);

        $order = BarangKeluar::firstOrCreate([
            'bbk_transaksi' => $request->bbk_transaksi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total'         => '0'
        ]);

        $bbm = BarangMasukDetail::findOrFail($request->id);

                $item = BarangKeluarDetail::firstOrCreate([
                    'barang_keluar_id' => $order->id,
                    'harga_transaksi' => $bbm->harga_transaksi,
                    'barang_id'       => $bbm->barang_id,
                    'diskon'          => $bbm->diskon,
                    'suplier_id'      => $bbm->suplier_id,
                    'keterangan_transaksi' => $bbm->keterangan_transaksi,
                    'bk_quantity'       => $bbm->bm_quantity,
                    'barang_masuk_detail_id' => $bbm->id
                ]);

                $bbm->bm_quantity -= $item->bk_quantity;
                $bbm->save();
        
        $gudang = Gudang::firstOrNew([
            'barang_id' => $item->barang_id,
            'suplier_id' => $bbm->suplier_id
        ]);
        $gudang->jumlah_sebelum = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
        $jumlah = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
        $gudang->jumlah -= $bbm->bm_quantity;
        $gudang->save();


        $total = BarangKeluar::findOrFail($order->id);
        $total->total += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->bk_quantity;
        $total->update();
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data BBK <strong>$order->bk_transaksi</strong>"
        ]);

        return redirect('barang-keluar/' . $order->id . '/edit');
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

        $sot = BarangKeluar::findOrFail($id);
        $dbm = BarangKeluarDetail::where('barang_keluar_id', $id)->get();

        $title = 'Detail: No. ' . $sot->bbk_transaksi;
        $route = 'barang-keluar';
        
        return view($route . '.show', compact('title', 'route', 'sot', 'sob', 'dbm'));
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

        $route  = 'barang-keluar';
        $title  = 'Tambah Bukti Barang Keluar';
        $button = 'Tambah';
        $controller = 'BarangKeluarController';
        
        $order  = BarangKeluar::findOrFail($id);
        $bbk = BarangKeluarDetail::where('barang_keluar_id', $id)->get();

        $barang = BarangMasukDetail::where('bm_quantity', '>', 0)
                                ->whereExists(function($query) {
                                    $query->selectRaw('so_transaksi_barangs.barang_id')
                                            ->from('so_transaksi_barangs')
                                            ->where('harga_transaksi', '!=', '0')
                                            ->whereRaw('so_transaksi_barangs.barang_id = barang_masuk_details.barang_id');
                                    })
                                    ->get();

        return view($route.'.edit', compact('title', 'controller', 'route', 'order', 'button', 'bbk', 'order_barang', 'barang'));
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
            'id'          => 'required'
        ]);

        $bbm = BarangMasukDetail::findOrFail($request->id);
        

                $item = BarangKeluarDetail::firstOrCreate([
                    'barang_keluar_id' => $id,
                    'harga_transaksi' => $bbm->harga_transaksi,
                    'barang_id'       => $bbm->barang_id,
                    'suplier_id'      => $bbm->suplier_id,
                    'keterangan_transaksi' => $bbm->keterangan_transaksi,
                    'bk_quantity'       => $bbm->bm_quantity,
                    'diskon'            => $bbm->diskon,
                    'barang_masuk_detail_id' => $bbm->id
                ]);

                $bbm->bm_quantity -= $item->bk_quantity;
                $bbm->save();

                $gudang = Gudang::firstOrNew([
                    'barang_id' => $item->barang_id,
                    'suplier_id' => $bbm->suplier_id
                ]);
                $gudang->jumlah_sebelum = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
                $jumlah = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
                $gudang->jumlah -= $bbm->bm_quantity;
                $gudang->save();

                $order = BarangKeluar::findOrFail($id);
                $order->total += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->bk_quantity;
                $order->update();

            Session::flash("flash_notif", [
                "level"     => "dismissible alert-success",
                "message"   => "Berhasil, barang keluar <strong>" . $bbm->barang->nama_barang . "</strong> " . $request->bk_quantity . $bbm->barang->satuan->nama_satuan
            ]);
        
        return redirect('barang-keluar/' . $id . '/edit');
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

        $sot = BarangKeluar::findOrFail($id);
        $detail_barang   = BarangKeluarDetail::where('barang_keluar_id', $id)->get();
        foreach($detail_barang as $g) {
            
            
            $gudang = Gudang::firstOrNew([
                'barang_id' => $g->barang_id,
                'suplier_id' => $g->suplier_id
            ]);
            $gudang->jumlah += $g->bk_quantity;
            $gudang->save();
            
            $g->delete();
        }
        $sot->delete();

        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Barang Keluar Purchase Order <strong>$sot->bbk_transaksi</strong>"
            ]);

        return \Redirect::route('barang-keluar.index');
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
        $title = 'Barang Purchase Order Keluar - Pencarian ' . $kata_kunci;
        $route = 'barang-keluar';
        
        $order   = BarangKeluar::where('bbk_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                               ->orderBy('bbk_transaksi', 'asc')
                               ->paginate(20);

        return view($route . '.index', compact('title', 'order', 'route'));
    }
}

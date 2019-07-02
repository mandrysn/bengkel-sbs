<?php

namespace App\Http\Controllers;

use Session;
use App\Permission;
use Auth;
use PDF;
use App\BuktiKeluar;
use App\BuktiMaterialDetail;
use App\BuktiKeluarDetail;
use App\Gudang;
use Illuminate\Http\Request;

class BuktiKeluarController extends Controller
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

        $route  = 'bukti-keluar';
        $title  = 'Barang Keluar';
        $order  = BuktiKeluar::orderby('tanggal_masuk', 'asc')->paginate(20);

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

        $route   = 'bukti-keluar';
        $title   = 'Tambah Pemakaian Barang Pribadi';

        $cari   = BuktiKeluar::where('bbk_material', 'LIKE', '%SBS' . date('Y') . '-BBMK%')->orderby('id', 'desc')->get()->count();
        if ($cari < 1 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-BBK' . sprintf("%05s", $add);

        $button  = 'Selanjutnya';

                $barang = BuktiMaterialDetail::where('bm_quantity', '>', 0)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('bukti_keluar_details.bukti_material_detail_id')
                                            ->from('bukti_keluar_details')
                                            ->whereRaw('bukti_keluar_details.bukti_material_detail_id = bukti_material_details.id');
                                    })
                                    ->get();
        
        return view('template.create', compact('title', 'button', 'route', 'kode', 'barang'));
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
            'bbk_material' => 'required|unique:bukti_keluars',
            'id'           => 'required'
        ]);

        $order = BuktiKeluar::firstOrCreate([
            'bbk_material' => $request->bbk_material,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total'         => '0'
        ]);

        $bbm = BuktiMaterialDetail::findOrFail($request->id);

                $item = BuktiKeluarDetail::firstOrCreate([
                    'bukti_keluar_id' => $order->id,
                    'harga_transaksi' => $bbm->harga_transaksi,
                    'barang_id'       => $bbm->barang_id,
                    'diskon'          => $bbm->diskon,
                    'suplier_id'      => $bbm->suplier_id,
                    'keterangan_transaksi' => $bbm->keterangan_transaksi,
                    'bk_quantity'     => $bbm->bm_quantity,
                    'bukti_material_detail_id' => $bbm->id
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

        $total = BuktiKeluar::findOrFail($order->id);
        $total->total += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->bk_quantity;
        $total->update();

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data BBK Material <strong>$order->bk_transaksi</strong>"
        ]);

        return redirect('bukti-keluar/' . $order->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BuktiKeluar  $buktiKeluar
     * @return \Illuminate\Http\Response
     */
    public function show($buktiKeluar)
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

        $sot = BuktiKeluar::findOrFail($buktiKeluar);
        $dbm = BuktiKeluarDetail::where('bukti_keluar_id', $buktiKeluar)->get();

        $title = 'Detail: No. ' . $sot->bbk_material;
        $route = 'bukti-keluar';
        
        return view($route . '.show', compact('title', 'route', 'sot', 'sob', 'dbm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuktiKeluar  $buktiKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BuktiKeluar $buktiKeluar)
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

        $route  = 'bukti-keluar';
        $title  = 'Tambah Bukti Material Keluar';
        $button = 'Tambah';
        $controller = 'BuktiKeluarController';
        
        $order  = $buktiKeluar;
        $bbk = BuktiKeluarDetail::where('bukti_keluar_id', $buktiKeluar->id)->get();

        $barang = BuktiMaterialDetail::where('bm_quantity', '>', 0)
                                ->whereExists(function($query) {
                                    $query->selectRaw('material_barangs.barang_id')
                                            ->from('material_barangs')
                                            ->where('harga_transaksi', '!=', '0')
                                            ->whereRaw('material_barangs.barang_id = bukti_material_details.barang_id');
                                    })
                                    ->get();

        return view($route.'.edit', compact('title', 'controller', 'route', 'order', 'button', 'bbk', 'order_barang', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuktiKeluar  $buktiKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $buktiKeluar)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $bbm = BuktiMaterialDetail::findOrFail($request->id);
        

                $item = BuktiKeluarDetail::firstOrCreate([
                    'bukti_keluar_id' => $buktiKeluar,
                    'harga_transaksi' => $bbm->harga_transaksi,
                    'barang_id'       => $bbm->barang_id,
                    'suplier_id'      => $bbm->suplier_id,
                    'keterangan_transaksi' => $bbm->keterangan_transaksi,
                    'bk_quantity'       => $bbm->bm_quantity,
                    'diskon'          => $bbm->diskon,
                    'bukti_material_detail_id' => $bbm->id
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

                $order = BuktiKeluar::findOrFail($id);
                $order->total += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->bk_quantity;
                $order->update();

            Session::flash("flash_notif", [
                "level"     => "dismissible alert-success",
                "message"   => "Berhasil, material keluar <strong>" . $bbm->barang->nama_barang . "</strong> " . $request->bk_quantity . $bbm->barang->satuan->nama_satuan
            ]);
        
        return redirect('bukti-keluar/' . $buktiKeluar . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuktiKeluar  $buktiKeluar
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

        $sot = BuktiKeluar::findOrFail($id);
        $detail_barang   = BuktiKeluarDetail::where('bukti_keluar_id', $id)->get();
        foreach($detail_barang as $g) {
            
            $gudang = Gudang::firstOrNew([
                'barang_id' => $detail_barang->barang_id,
                'suplier_id' => $detail_barang->suplier_id
            ]);
            $gudang->jumlah += $detail_barang->bk_quantity;
            $gudang->save();

            $g->delete();
        }
        $sot->delete();

        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Barang Keluar Pengajuan <strong>$sot->bbk_transaksi</strong>"
            ]);

        return \Redirect::route('bukti-keluar.index');
    }
}

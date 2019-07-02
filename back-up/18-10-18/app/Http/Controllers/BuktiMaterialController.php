<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use Auth;

use App\Gudang;
use App\Utang;
use App\Permission;
use App\Material;
use App\MaterialBarang;
use App\BuktiMaterial;
use App\BuktiMaterialDetail;
use Illuminate\Http\Request;

class BuktiMaterialController extends Controller
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

        $route  = 'bukti-material';
        $title  = 'Bukti Pengajuan Pembayaran Masuk';
        $order   = BuktiMaterial::orderby('tanggal_masuk', 'asc')->paginate(20);

        return view($route.'.index', compact('title', 'order', 'route'));    }

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

        $route   = 'bukti-material';
        $title   = 'Tambah Bukti Pengajuan Pembayaran Masuk';

        $notransaksi = Material::whereNotExists(function($query) {
                                    $query->selectRaw('bukti_materials.material_id')
                                            ->from('bukti_materials')
                                            ->whereRaw('materials.id = bukti_materials.material_id');
                                    })
                                    ->get();


        $cari   = BuktiMaterial::where('bbm_material', 'LIKE', '%SBS' . date('Y') . '-MA%')->orderby('id', 'desc')->get()->count();
        if ($cari < 1 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-MA' . sprintf("%04s", $add);

        $button  = 'Selanjutnya';
        
        return view('template.create', compact('title', 'button', 'route', 'notransaksi', 'kode'));
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
            'bbm_material'  => 'required|unique:bukti_materials',
            'tanggal_masuk' => 'required',
            'material_id'   => 'required'
        ]);

        $bm = BuktiMaterial::firstOrCreate([
            'material_id' => $request->material_id,
            'bbm_material'   => $request->bbm_material,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'total' => '0'
        ]);

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data BBM <strong>$bm->bbm_material</strong>"
        ]);

        return redirect('bukti-material/' . $bm->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BuktiMaterial  $buktiMaterial
     * @return \Illuminate\Http\Response
     */
    public function show($buktiMaterial)
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

        $sot = BuktiMaterial::findOrFail($buktiMaterial);
        $dbm = BuktiMaterialDetail::where('bukti_material_id', $buktiMaterial)->get();
        
        $barang = MaterialBarang::where('material_id', $sot->material_id)
                                    ->where('ma_quantity', '>', 0)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('bukti_material_details.material_barang_id')
                                            ->from('bukti_material_details')
                                            ->whereRaw('bukti_material_details.material_barang_id = material_barangs.id');
                                    })
                                    ->get();

        $title = 'No. ' . $sot->bbm_material;
        $route = 'bukti-material';
        
        return view($route . '.show', compact('title', 'route', 'sot', 'sob', 'dbm', 'barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuktiMaterial  $buktiMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit($buktiMaterial)
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

        $route  = 'bukti-material';
        $title  = 'Edit Bukti Pengajuan Pembayaran Masuk';
        $button = 'Tambah';
        $controller = 'BuktiMaterialDetailController';
        
        $sot = BuktiMaterial::findOrFail($buktiMaterial);
        $dbm = BuktiMaterialDetail::where('bukti_material_id', $buktiMaterial)->get();
        
        $barang = MaterialBarang::where('material_id', $sot->material_id)
                                    ->where('ma_quantity', '>', 0)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('bukti_material_details.material_barang_id')
                                              ->from('bukti_material_details')
                                              ->whereRaw('bukti_material_details.material_barang_id = material_barangs.id');
                                    })
                                    ->get();

        return view($route.'.edit', compact('title', 'controller', 'route', 'button', 'sot', 'dbm', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuktiMaterial  $buktiMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $buktiMaterial)
    {
        $this->validate($request, [
            'material_barang_id' => 'required'
        ]);

        $sotransaksi = MaterialBarang::findOrFail($request->material_barang_id);
        $suplier = Material::findOrFail($sotransaksi->material_id);

        $item = BuktiMaterialDetail::firstOrCreate([
            'bukti_material_id' => $buktiMaterial,
            'material_barang_id' => $request->material_barang_id,
            'bm_quantity'     => $sotransaksi->ma_quantity,
            'quantity'        => $sotransaksi->ma_quantity,
            'harga_transaksi' => $sotransaksi->harga_transaksi,
            'diskon'          => $sotransaksi->diskon,
            'barang_id'       => $sotransaksi->barang_id,
            'suplier_id'       => $suplier->suplier_id,
            'keterangan_transaksi' => $sotransaksi->keterangan_transaksi
        ]);

        $gudang = Gudang::firstOrNew([
            'barang_id' => $item->barang_id,
            'suplier_id' => $item->suplier_id
        ]);
        $gudang->jumlah_sebelum = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
        $jumlah = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
        $gudang->jumlah += $item->bm_quantity;
        $gudang->save();
            
        $utang = Utang::firstOrNew([
            'suplier_id' => $item->suplier_id
        ]);
        $utang->jumlah += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->bm_quantity;
        $utang->sisa += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->bm_quantity;
        $utang->save();

        $order = BuktiMaterial::findOrFail($buktiMaterial);
        $order->total += ( $item->harga_transaksi - ($item->harga_transaksi * $item->diskon / 100) ) * $item->quantity;
        $order->update();
            
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, bukti material masuk <strong>" . $sotransaksi->barang->nama_barang . "</strong> " . " $sotransaksi->ma_quantity " . $sotransaksi->barang->satuan->nama_satuan
        ]);
            
        return redirect('bukti-material/' . $buktiMaterial . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuktiMaterial  $buktiMaterial
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

        $sot = BuktiMaterial::findOrFail($id);
        
        $detail_barang = BuktiMaterialDetail::where('bukti_material_id', $id)->get();
        foreach($detail_barang as $g) {

            $gudang = Gudang::firstOrNew([
                'barang_id' => $g->barang_id,
                'suplier_id' => $g->suplier_id
            ]);
            $gudang->jumlah -= $g->bm_quantity;
            $gudang->save();
            
            $utang = Utang::firstOrNew([
                'suplier_id' => $g->suplier_id
            ]);
            $utang->jumlah -= ( $g->harga_transaksi - ($g->harga_transaksi * $g->diskon / 100) ) * $g->quantity;
            $utang->sisa -= ( $g->harga_transaksi - ($g->harga_transaksi * $g->diskon / 100) ) * $g->quantity;
            $utang->save();
            
            $g->delete();

        }
        $sot->delete();

        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Barang Masuk Pengajuan Pembayaran <strong>$sot->bbm_material</strong>"
            ]);

        return \Redirect::route('bukti-material.index');
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
        $title = 'Bukti Pengajuan Pembayaran Masuk - Pencarian ' . $kata_kunci;
        $route = 'bukti-material';
        
        $order   = BuktiMaterial::where('bbm_material', 'LIKE', '%' . $kata_kunci . '%')
                                ->orderBy('tanggal_masuk', 'asc')
                                ->paginate(20);

        return view($route . '.index', compact('title', 'order', 'route'));
    }
}

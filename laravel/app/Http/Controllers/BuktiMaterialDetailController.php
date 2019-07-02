<?php

namespace App\Http\Controllers;

use App\Material;
use App\BuktiMaterial;
use App\BuktiMaterialBarang;
use App\Gudang;
use App\Utang;
use App\Permission;
use Auth;
use Session;
use App\BuktiMaterialDetail;
use Illuminate\Http\Request;

class BuktiMaterialDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\BuktiMaterialDetail  $buktiMaterialDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BuktiMaterialDetail $buktiMaterialDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuktiMaterialDetail  $buktiMaterialDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BuktiMaterialDetail $buktiMaterialDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuktiMaterialDetail  $buktiMaterialDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $buktiMaterialDetail)
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

        $this->validate($request, [
            'harga_transaksi' => 'required',
            'bm_quantity'     => 'required',
            'suplier_id'      => 'required',
            'total'           => 'required',
            'qty'             => 'required'
        ]);
        
        $item = BuktiMaterialDetail::findOrFail($id);
        $item->bm_quantity = $request->bm_quantity;
        $item->quantity = $request->bm_quantity;
        $item->harga_transaksi = $request->harga_transaksi;
        $item->update();
        
        $gudang = Gudang::firstOrNew([
            'barang_id' => $item->barang_id,
            'suplier_id' => $request->suplier_id
        ]);
        $gudang->jumlah_sebelum = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
        $jumlah = is_null($gudang->jumlah) ? 0 : $gudang->jumlah;
        $gudang->jumlah += $request->bm_quantity - $gudang->jumlah_sebelum;
        $gudang->save();
        
        $hitung = ( $request->harga_transaksi - ($request->harga_transaksi * $item->diskon / 100) ) * $item->bm_quantity;
        $utang = Utang::firstOrNew([
            'suplier_id' => $request->suplier_id
        ]);

        if ( $hitung < $request->total) {
            $sparepart = ($request->total - $hitung);
            $utang->jumlah -= $sparepart;
            $utang->sisa -= $sparepart;
        } else {
            $sparepart = ($hitung - $request->total);
            $utang->jumlah += $sparepart;
            $utang->sisa += $sparepart;
        }

        $utang->save();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui Barang <strong> $item->quantity_bm " . $item->barang->satuan->nama_satuan . " " . $item->barang->nama_barang . "</strong>"
            ]);
        
        return redirect('barang-masuk/' . $item->barang_masuk_id . '/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuktiMaterialDetail  $buktiMaterialDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($buktiMaterialDetail)
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

        $data = BuktiMaterialDetail::findOrFail($buktiMaterialDetail);
        $data->delete();
        
        $gudang = Gudang::firstOrNew([
            'barang_id' => $data->barang_id,
            'suplier_id' => $data->suplier_id
        ]);
        $gudang->jumlah -= $data->bm_quantity;
        $gudang->save();
        
        $utang = Utang::firstOrNew([
            'suplier_id' => $data->suplier_id
        ]);
        $utang->jumlah -= ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bm_quantity;
        $utang->sisa -= ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bm_quantity;
        $utang->save();
    
        $transaksi = BuktiMaterial::findOrFail($data->bukti_material_id);
        if ($transaksi->total > 0) {
            
            $transaksi->total = $transaksi->total - ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity;
            $transaksi->update();
            
        }

        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data"
            ]);
        
        return redirect('bukti-material/'. $data->bukti_material_id .'/edit/');
    }
}

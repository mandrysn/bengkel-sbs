<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Session;
use App\Satuan;
use App\Barang;
use App\Suplier;
use App\PoTransaksi;
use App\Material;
use App\MaterialBarang;
use App\PoTransaksiBarang;
use App\Permission;
use Auth;

class MaTransaksiController extends Controller
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

        $title = 'Pengajuan Pembayaran';
        $route = 'order-material';
        $cari  = 'cari-order-material';
        
        $order_material = Material::where('ma_transaksi', 'LIKE', '%-PO/MA%')->orderby('tanggal_masuk', 'asc')->paginate(20);
		
        foreach ($order_material as $data) {
            $detail_barang = MaterialBarang::paginate(20);
            $tagihan_barang = 0;
            $total_barang = 0;
            foreach($detail_barang as $datab) {
                $tagihan_barang = ( $datab->harga_transaksi - ($datab->harga_transaksi * $datab->diskon / 100) ) * $datab->ma_quantity;
                $total_barang += $tagihan_barang;
            }
            $totalm = $total_barang;
        }
        
        return view($route . '.index', compact('title', 'order_material', 'totalm', 'cari', 'route'));
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

        $route   = 'order-material';
        $title   = 'Tambah Pengajuan Pembayaran';
        $button  = 'Tambah';
        
        $suplier = Suplier::where('deleted', 'N')->pluck('nama_suplier', 'id')->all();
        $barang = Barang::where('deleted', 'N')->get();

        $cari   = Material::where('ma_transaksi', 'LIKE', '%SBS' . date('Y') . '-PO/MA%')->orderby('id', 'desc')->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-PO/MA' . sprintf("%04s", $add);
        
        
        return view('template.create', compact('title', 'button', 'route', 'barang', 'suplier', 'kode'));
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
            'suplier_id'    => 'required',
            'tanggal_masuk' => 'required',
            'ma_transaksi'  => 'required|unique:materials',
            'barang_id'     => 'required',
            'ma_quantity'   => 'required'
        ]);

        $barang = Barang::where('id', $request->barang_id)->first();

        $ma = Material::firstOrCreate([
            'ma_transaksi' => $request->ma_transaksi,
            'suplier_id' => $request->suplier_id,
            'tanggal_masuk'=> $request->tanggal_masuk,
            'total' => '0'
        ]);

        $matransaksi = MaterialBarang::firstOrCreate([
            'material_id' => $ma->id,
            'ma_quantity' => $request->ma_quantity,
            'harga_transaksi' => $barang->harga_beli,
            'barang_id'   => $request->barang_id,
            'diskon'      => empty($request->diskon) ? '0' : $request->diskon
        ]);

        $order = Material::findOrFail($ma->id);
        $order->total += ( $matransaksi->harga_transaksi - ($matransaksi->harga_transaksi * $matransaksi->diskon / 100) ) * $matransaksi->ma_quantity;
        $order->update();

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data Order Material <strong>$request->ma_transaksi</strong>"
        ]);

        return redirect('order-material/' . $ma->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaTransaksi  $maTransaksi
     * @return \Illuminate\Http\Response
     */
    public function show($maTransaksi)
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

        $route  = 'order-material';
        $title  = 'Detail Pengajuan Pembayaran';
        $controller = 'MaTransaksiController';
        
        $transaksi = Material::findOrFail($maTransaksi);

        $ma   = MaterialBarang::where('material_id', $maTransaksi)->get();
        $total = 0;

        return view($route . '.show', compact('title', 'controller', 'route', 'transaksi', 'ma', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaTransaksi  $maTransaksi
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

        $route  = 'order-material';
        $title  = 'Tambah Pengajuan Pembayaran';
        $button = 'Tambah';
        $controller = 'MaTransaksiController';
        
        $barang = Barang::where('deleted', 'N')->get();
        $transaksi = Material::findOrFail($id);

        $ma   = MaterialBarang::where('material_id', $id)->get();
        $total = 0;

        return view($route . '.edit', compact('title', 'controller', 'route', 'barang', 'transaksi', 'button', 'ma', 'total'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaTransaksi  $maTransaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $maTransaksi)
    {
        $this->validate($request, [
            'barang_id'  => 'required',
            'quantity'   => 'required'
        ]);
        
        $barang = Barang::findOrFail($request->barang_id);
        
        $matransaksi = MaterialBarang::firstOrCreate([
            'material_id' => $maTransaksi,
            'ma_quantity' => $request->quantity,
            'harga_transaksi' => $barang->harga_beli,
            'barang_id'   => $request->barang_id,
            'diskon'      => empty($request->diskon) ? '0' : $request->diskon,
			'keterangan_transaksi' => $request->keterangan_transaksi
        ]);

        $order = Material::findOrFail($maTransaksi);
        $order->total += ( $matransaksi->harga_transaksi - ($matransaksi->harga_transaksi * $matransaksi->diskon / 100) ) * $matransaksi->ma_quantity;
        $order->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, menambah transaksi material"
            ]);

        return redirect('order-material/'. $maTransaksi .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaTransaksi  $maTransaksi
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

        $pot = Material::findOrFail($id);
        $pot->delete();

        $data = MaterialBarang::where('material_id', $id)->get();
        foreach($data as $d) {
            $d->delete();
        }
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Pemesanan Material <strong>$pot->ma_transaksi</strong>"
            ]);
        
        return redirect('order-material/');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        //
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

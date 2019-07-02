<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use View;
use Session;
use App\SoTransaksi;
use App\PoTransaksi;
use App\Barang;
use App\Suplier;
use App\Permission;
use Auth;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;

class PemesananBarangController extends Controller
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

        $route  = 'order-barang';
        $title  = 'Pemesanan Barang';
        $order  = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/SO%')->orderby('created_at', 'asc')->paginate(20);
        
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

        $route   = 'order-barang';
        $title   = 'Tambah Pemesanan Barang';
        
        $suplier = Suplier::where('deleted', 'N')->pluck('nama_suplier', 'id')->all();
        $barang = Barang::where('deleted', 'N')->pluck('nama_barang', 'id')->all();
        // $sotransaksi = PoTransaksi::whereNull('po_transaksi')->pluck('no_transaksi', 'id')->all();
        
        $cari   = PoTransaksi::where('po_transaksi', 'LIKE', '%SBS' . date('Y') . '-PO/SO%')->orderby('id', 'desc')->first();
        if ( is_null($cari) ) {
            $add = 1;
        } else {
            $add = $cari->id + 1;
        }
        $kode = 'SBS' . date('Y') . '-PO/SO' . sprintf("%04s", $add);

        $button  = 'Selanjutnya';
        
        return view('template.create', compact('title', 'button', 'route', 'barang', 'kode', 'suplier'));
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
            'suplier_id' => 'required',
            'tanggal_masuk' => 'required',
            'po_transaksi' => 'required|unique:po_transaksis'
        ]);

        $po = PoTransaksi::firstOrCreate([
            'po_transaksi' => $request->po_transaksi,
            'suplier_id'      => $request->suplier_id,
            'tanggal_masuk'=> $request->tanggal_masuk
        ]);
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data Order <strong>$po->po_transaksi</strong>"
        ]);

        return redirect('order-barang/' . $po->id . '/edit');
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

        $route  = 'order-barang';
        $title  = 'Detail Pemesanan Barang';
        $button = 'Tambah';
        $controller = 'PemesananBarangController';
        
        $sot = PoTransaksi::findOrFail($id);
        $order_barang = PoTransaksiBarang::where('po_transaksi_id', $id)
                                            ->get();

        $barang = SoTransaksiBarang::whereNotNull('harga_transaksi')
                            ->whereNotExists(function($query) {
                                $query->selectRaw('po_transaksi_barangs.po_transaksi_id')
                                    ->from('po_transaksi_barangs')
                                    ->whereRaw('so_transaksi_barangs.id = po_transaksi_barangs.so_transaksi_barang_id');
                            })
                            ->where('quantity', '>', 0)
                            ->get();


        return view($route . '.show', compact('title', 'controller', 'route', 'sot', 'button', 'order_barang', 'barang'));
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

        $route  = 'order-barang';
        $title  = 'Tambah Pemesanan Barang';
        $button = 'Tambah';
        $controller = 'PemesananBarangController';
        
        $order = PoTransaksi::findOrFail($id);
        $order_barang = PoTransaksiBarang::where('po_transaksi_id', $id)
                                            ->get();

        $barang = SoTransaksiBarang::whereNotNull('harga_transaksi')
                            ->whereNotExists(function($query) {
                                $query->selectRaw('po_transaksi_barangs.po_transaksi_id')
                                    ->from('po_transaksi_barangs')
                                    ->whereRaw('so_transaksi_barangs.id = po_transaksi_barangs.so_transaksi_barang_id');
                            })
                            ->where('quantity', '>', 0)
                            ->get();


        return view($route . '.edit', compact('title', 'controller', 'route', 'order', 'button', 'order_barang', 'barang'));
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
            'id' => 'required'
        ]);

        $sotransaksi = SoTransaksiBarang::findOrFail($request->id);
        $potransaksi = PoTransaksiBarang::where('po_transaksi_id', $id)
                                        ->where('barang_id', $sotransaksi->barang_id)
                                        ->where('so_transaksi_barang_id', $request->id);

        if ($request->quantity > $sotransaksi->quantity_po ) {
            $info = "warning";
            $pesan = "Gagal, Jumlah yang dimasukkan melebihi Jumlah yang dipesan, barang yang tersisa adalah <strong>" . $sotransaksi->quantity . " " . $sotransaksi->barang->satuan->nama_satuan . "</strong>";
        } else {

            if ( empty($request->diskon) ) {
                $diskon = 0;
            } else {
                $diskon = $request->diskon;
            }
            
            if ( $potransaksi->count() == 0 ) {
                $po = PoTransaksiBarang::firstOrCreate([
                    'so_transaksi_barang_id' => $sotransaksi->id,
                    'po_transaksi_id' => $id,
                    'po_quantity'     => $sotransaksi->quantity,
                    'diskon'          => $diskon,
                    'barang_id'       => $sotransaksi->barang_id
                ]);

                $info = "success";
                $pesan = "Berhasil, memperbarui data Order <strong> " . $sotransaksi->barang->nama_barang . "</strong>";

            } else {
                $pt = PoTransaksiBarang::firstOrNew([
                    'barang_id' => $sotransaksi->barang_id,
                    'so_transaksi_barang_id' => $sotransaksi->id,
                    'diskon'          => $diskon,
                    'po_transaksi_id' => $id
                ]);
                $pt->po_quantity += $sotransaksi->quantity;
                $pt->save();

                $sotransaksi->quantity_po -= $sotransaksi->quantity;
                $sotransaksi->update();

                $info = "success";
                $pesan = "Berhasil, memperbarui data Order <strong> " . $sotransaksi->barang->nama_barang . "</strong>";
            }
        }

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-" . $info,
            "message"   => $pesan
        ]);

        return redirect('order-barang/'.$id.'/edit');
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

        $pot = PoTransaksi::findOrFail($id);
        $data = PoTransaksiBarang::where('po_transaksi_id', $id)->get();
        
        foreach($data as $d) {
        $barang = SoTransaksiBarang::findOrFail($d->so_transaksi_barang_id);
        $barang->quantity += $d->po_quantity;
        $barang->update();

        $d->delete();
        }
        $pot->delete();
        
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Pemesanan Barang <strong>$pot->po_transaksi</strong>"
            ]);
        
        return redirect('order-barang/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        $transaksi = PoTransaksi::findOrFail($id);
        $details = PoTransaksiBarang::where('po_transaksi_id', $id)->get();
        $title     = 'Pemesanan Barang No. ' . $transaksi->po_transaksi;
        
        $pdf = PDF::loadview('order-barang.print', compact('transaksi', 'details', 'title'));
        // return view('order-barang.print', compact('transaksi', 'details', 'title'));
        return $pdf->setPaper('f4')->download('PO-'.$transaksi->po_transaksi.'.pdf');
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
        $title = 'Order Barang - Pencarian ' . $kata_kunci;
        $route = 'order-barang';
        
        $order = PoTransaksi::where('po_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                    ->orderBy('po_transaksi', 'asc')
                    ->paginate(20);

        return view($route.'.index', compact('title', 'order', 'route'));
    }
}

<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Permission;
use Auth;
use App\Barang;
use App\Gudang;
use App\Utang;
use App\SoTransaksi;
use App\PoTransaksi;
use App\BarangMasuk;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;
use App\BarangMasukDetail;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
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

        $route  = 'barang-masuk';
        $title  = 'Barang Masuk';
        $order   = BarangMasuk::orderby('tanggal_masuk', 'asc')->paginate(20);

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

        $route   = 'barang-masuk';
        $title   = 'Tambah Sparepart Datang';

        $notransaksi = PoTransaksi::whereNotExists(function($query) {
                                    $query->selectRaw('barang_masuks.po_transaksi_id')
                                            ->from('barang_masuks')
                                            ->whereRaw('po_transaksis.id = barang_masuks.po_transaksi_id');
                                    })
                                    ->get();


        // $notransaksi = SoTransaksi::whereNotNull('po_transaksi')
        //                             ->whereNotExists(function($query) {
        //                                 $query->selectRaw('barang_masuks.so_transaksi_id')
        //                                     ->from('barang_masuks')
        //                                     ->whereRaw('so_transaksis.id = barang_masuks.so_transaksi_id');
        //                             })
        //                             ->pluck('po_transaksi', 'id')
        //                             ->all();

        $cari   = BarangMasuk::where('bbm_transaksi', 'LIKE', '%SBS' . date('Y') . '-BBM%')->orderby('id', 'desc')->get()->count();
        if ($cari < 1 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-BBM' . sprintf("%04s", $add);

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
        // insert-update multiple
        // $sob = SoTransaksiBarang::where('so_transaksi_id', $request->id)->get();
        // foreach ($sob as $key => $data) {
        //     $save = Gudang::firstOrNew([
        //         'barang_id' => $data->barang_id
        //     ]);
        //     $save->jumlah += $data->quantity;
        //     $save->save();
        // }

        $this->validate($request, [
            'po_transaksi_id' => 'required',
            'bbm_transaksi'   => 'required|unique:barang_masuks'
        ]);

        $bm = BarangMasuk::firstOrCreate([
            'po_transaksi_id' => $request->po_transaksi_id,
            'bbm_transaksi'   => $request->bbm_transaksi,
            'tanggal_masuk'   => $request->tanggal_masuk
        ]);

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data BBM <strong>$bm->bbm_transaksi</strong>"
        ]);

        return redirect('barang-masuk/' . $bm->id . '/edit');
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

        $sot = BarangMasuk::findOrFail($id);
        $dbm = BarangMasukDetail::where('barang_masuk_id', $id)->get();
        
        $barang = PoTransaksiBarang::where('po_transaksi_id', $sot->po_transaksi_id)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('barang_masuk_details.po_transaksi_barang_id')
                                            ->from('barang_masuk_details')
                                            ->whereRaw('po_transaksi_barangs.id = barang_masuk_details.po_transaksi_barang_id');
                                    })
                                    ->where('po_quantity', '>', 0)
                                    ->get();

        $title = 'Detail: No. ' . $sot->bbm_transaksi;
        $route = 'barang-masuk';
        
        return view($route . '.show', compact('title', 'route', 'sot', 'sob', 'dbm', 'barang'));
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

        $route  = 'barang-masuk';
        $title  = 'Edit Bukti Barang Masuk';
        $button = 'Tambah';
        $controller = 'BarangMasukDetailController';
        
        $sot = BarangMasuk::findOrFail($id);
        $dbm = BarangMasukDetail::where('barang_masuk_id', $id)->get();
        
        $barang = PoTransaksiBarang::where('po_transaksi_id', $sot->po_transaksi_id)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('barang_masuk_details.po_transaksi_barang_id')
                                            ->from('barang_masuk_details')
                                            ->whereRaw('po_transaksi_barangs.id = barang_masuk_details.po_transaksi_barang_id');
                                    })
                                    ->where('po_quantity', '>', 0)
                                    ->get();

        return view($route.'.edit', compact('title', 'controller', 'route', 'button', 'sot', 'dbm', 'barang'));
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
            'so_transaksi_barang_id' => 'required'
        ]);

            $sotransaksi = SoTransaksiBarang::findOrFail($request->so_transaksi_barang_id);
            $suplier = PoTransaksiBarang::where('so_transaksi_barang_id', $request->so_transaksi_barang_id)->first();
            $item = BarangMasukDetail::firstOrCreate([
                'barang_masuk_id' => $id,
                'po_transaksi_barang_id' => $suplier->id,
                'bm_quantity'     => $sotransaksi->quantity,
                'quantity'        => $sotransaksi->quantity,
                'harga_transaksi' => $sotransaksi->barang->harga_beli,
                'diskon'          => $suplier->diskon,
                'barang_id'       => $sotransaksi->barang_id,
                'suplier_id'       => $suplier->potransaksi->suplier_id,
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
                
            Session::flash("flash_notif", [
                "level"     => "dismissible alert-success",
                "message"   => "Berhasil, bukti barang masuk <strong>" . $sotransaksi->barang->nama_barang . "</strong> " . " $sotransaksi->no_quantity " . $sotransaksi->barang->satuan->nama_satuan
            ]);
            
        return redirect('barang-masuk/' . $id . '/edit');
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
        $kata_kunci = $request->kata_kunci;
        $title = 'Barang Masuk - Pencarian ' . $kata_kunci;
        $route = 'barang-masuk';
        
        $order   = BarangMasuk::where('bbm_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                    ->orderBy('bbm_transaksi', 'asc')
                    ->paginate(20);

        return view('barang-masuk.index', compact('title', 'order', 'route'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        $sot = BarangMasuk::findOrFail($id);
        $dbm = BarangMasukDetail::where('barang_masuk_id', $id)->get();
        
        $barang = PoTransaksiBarang::where('po_transaksi_id', $sot->po_transaksi_id)
                                    ->whereNotExists(function($query) {
                                        $query->selectRaw('barang_masuk_details.po_transaksi_barang_id')
                                            ->from('barang_masuk_details')
                                            ->whereRaw('po_transaksi_barangs.id = barang_masuk_details.po_transaksi_barang_id');
                                    })
                                    ->where('po_quantity', '>', 0)
                                    ->get();

        $title = 'Detail: No. ' . $sot->bbm_transaksi;
        $route = 'barang-masuk';
        
        
        $pdf = PDF::loadview('barang-masuk.print',  compact('title', 'sot', 'sob', 'dbm', 'barang'));
        // return view('order-barang.print', compact('transaksi', 'details', 'title'));
        return $pdf->setPaper('f4')->download('BBM-'.$sot->bbm_transaksi.'.pdf');
    }
}

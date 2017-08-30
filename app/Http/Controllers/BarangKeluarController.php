<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\SoTransaksiBarang;
use App\Suplier;
use App\Asuransi;
use App\Barang;
use Session;

class BarangKeluarController extends Controller
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
        $route   = 'barang-keluar';
        $title   = 'Tambah Barang Keluar';

        $notransaksi = SoTransaksi::whereNotNull('bm_transaksi')
                                    ->whereNull('bk_transaksi')
                                    ->pluck('no_transaksi', 'id')
                                    ->all();

        $cari   = SoTransaksi::where('bk_transaksi', 'LIKE', '%SBS' . date('Y') . '-BBK%')->get()->count();
        if ($cari < 1 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-BBK' . sprintf("%04s", $add);

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
            'id' => 'required',
            'bk_transaksi'    => 'required|unique:so_transaksis'
        ]);

        $order = SoTransaksi::findOrFail($request->id);
        $order->bk_transaksi = $request->bk_transaksi;
        $order->update();
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route  = 'barang-keluar';
        $title  = 'Tambah Bukti Barang Keluar';
        $button = 'Tambah';
        $controller = 'BarangKeluarController';
        
        $order  = SoTransaksi::findOrFail($id);

        $barang = Barang::where('kategori_barang', 2)
                                ->whereExists(function($query) {
                                    $query->selectRaw('so_transaksi_barangs.barang_id')
                                            ->from('so_transaksi_barangs')
                                            ->whereNotNull('suplier_id')
                                            ->where('harga_transaksi', '!=', '0')
                                            ->whereRaw('so_transaksi_barangs.barang_id = barangs.id');
                                    })
                                    ->pluck('nama_barang', 'id')
                                    ->all();

        $order_barang = SoTransaksiBarang::where('so_transaksi_id', $id)
                                         ->get();

        $suplier = Suplier::pluck('nama_suplier', 'id')->all();

        return view('barang-keluar.edit', compact('title', 'controller', 'route', 'order', 'button', 'suplier', 'order_barang', 'barang'));
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
            'id'          => 'required',
            'quantity_bk' => 'required'
        ]);
        
        $transaksi_barang = SoTransaksiBarang::findOrFail($id);
        if ( $transaksi_barang->quantity < $request->quantity_bk ) {
            $info  = 'alert';
            $pesan = 'Jumlah yang dimasukkan tidak mencukupi stok di gudang';
        } else {
            $transaksi_barang->quantity_bk = $request->quantity_bk;
            $transaksi_barang->keterangan_transaksi = $request->keterangan_transaksi;
            $transaksi_barang->update();

            $info  = 'info';
            $pesan = 'Berhasil, mengeluarkan ' . $transaksi_barang->barang->nama_barang . ' ' . $transaksi_barang->quantity_bk . ' ' . $transaksi_barang->barang->satuan->nama_satuan . ' barang transaksi ';
            
        }

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-" . $info,
                "message"   => $pesan
            ]);

        return redirect('barang-keluar/'. $id .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

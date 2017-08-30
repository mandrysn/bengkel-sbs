<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Satuan;
use App\Barang;
use App\Suplier;
use App\PoTransaksi;
use App\SoTransaksi;
use App\SoPelanggan;
use App\SoKendaraan;
use App\SoTransaksiBarang;
use App\PoTransaksiBarang;
use Illuminate\Http\Request;

class MaTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Barang Material';
        $route = 'order-material';
        
        $order_material = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/MA%')->orderby('created_at', 'asc')->paginate(20);
        
        return view('order-material.index', compact('title', 'order_material', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route   = 'order-material';
        $title   = 'Tambah Pemesanan Material';
        
        $suplier = Suplier::pluck('nama_suplier', 'id')->all();
        $barang = Barang::where('kategori_barang', 1)->pluck('nama_barang', 'id')->all();
        $cari   = SoTransaksi::where('no_transaksi', 'LIKE', '%SBS' . date('Y') . '-MA%')->get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $noma = 'SBS' . date('Y') . '-MA' . sprintf("%04s", $add);

        $ma     = PoTransaksi::where('po_transaksi', 'LIKE', '%SBS' . date('Y') . '-PO/MA%')->get()->count();
        if($ma < 0 ) {
            $mdd = 1;
        } else {
            $mdd = $ma + 1;
        }
        $kode = 'SBS' . date('Y') . '-PO/MA' . sprintf("%04s", $mdd);
        
        $button  = 'Kirim';
        
        return view('template.create', compact('title', 'button', 'route', 'barang', 'suplier', 'kode', 'noma'));
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
            'no_transaksi'  => 'required|unique:so_transaksis',
            'po_transaksi'  => 'required|unique:po_transaksis',
            'barang_id'     => 'required',
            'quantity'      => 'required'
        ]);

        $barang = Barang::where('id', $request->barang_id)->first();

        $transaksi = SoTransaksi::firstOrCreate([
            'no_transaksi' => $request->no_transaksi,
            'tanggal_masuk'=> $request->tanggal_masuk
        ]);

        $pelanggan = SoPelanggan::firstOrNew([
            'no_claim' => $request->no_transaksi
        ]);
        $transaksi->sopelanggan()->save($pelanggan);

        $kendaraan = SoKendaraan::firstOrNew([
            'tanggal_masuk'   => $request->tanggal_masuk
        ]);
        $transaksi->sokendaraan()->save($kendaraan);
        
        $transaksi_barang = SoTransaksiBarang::firstOrCreate([
            'so_transaksi_id'      => $transaksi->id,
            'barang_id'            => $request->barang_id,
            'quantity'             => $request->quantity,
            'quantity_po'             => '0',
            'keterangan_transaksi' => $request->keterangan_transaksi,
            'harga_transaksi'      => $barang->harga_barang
        ]);

        $po = PoTransaksi::firstOrCreate([
            'po_transaksi' => $request->po_transaksi,
            'suplier_id'      => $request->suplier_id,
            'tanggal_masuk'=> $request->tanggal_masuk
        ]);
        $potransaksi = PoTransaksiBarang::firstOrCreate([
            'po_transaksi_id' => $po->id,
            'so_transaksi_barang_id' => $transaksi_barang->id,
            'po_quantity'   => $request->quantity
        ]);

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data Order Material <strong>$request->po_transaksi</strong>"
        ]);

        return redirect('order-material/' . $po->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaTransaksi  $maTransaksi
     * @return \Illuminate\Http\Response
     */
    public function show(MaTransaksi $maTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaTransaksi  $maTransaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route  = 'order-material';
        $title  = 'Tambah Pemesanan Material';
        $button = 'Tambah';
        $controller = 'MaTransaksiController';
        
        $barang = Barang::where('kategori_barang', 1)->pluck('nama_barang', 'id')->all();
        $transaksi = PoTransaksi::findOrFail($id);

        $ma   = PoTransaksiBarang::where('po_transaksi_id', $id)->get();

        return view('order-material.edit', compact('title', 'controller', 'route', 'barang', 'transaksi', 'button', 'ma'));
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
        $transaksi = SoTransaksiBarang::where('so_transaksi_id', $maTransaksi)
                                      ->where('barang_id', $request->barang_id);
        
        if ($transaksi->count() == 0) {
            $s = SoTransaksiBarang::firstOrCreate([
                'so_transaksi_id'      => $maTransaksi,
                'barang_id'            => $request->barang_id,
                'quantity'             => $request->quantity,
                'quantity_po'             => '0',
                'harga_transaksi'      => $barang->harga_barang,
                'keterangan_transaksi' => $request->keterangan_transaksi
            ]);

            PoTransaksiBarang::firstOrCreate([
                'so_transaksi_barang_id'      => $s->id,
                'po_transaksi_id'        => $maTransaksi,
                'po_quantity'             => $request->quantity,
            ]);
            $status = 'menambah';
        } else {
            $get = $transaksi->get();
            $transaksi_barang = SoTransaksiBarang::findOrFail($get->id);
            $transaksi_barang->quantity += $request->quantity;
            $transaksi_barang->keterangan_transaksi = $request->keterangan_transaksi;
            $transaksi_barang->update();
            
            $status = 'memperbarui';
        }
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, $status transaksi material"
            ]);

        return redirect('order-material/'. $maTransaksi .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaTransaksi  $maTransaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaTransaksi $maTransaksi)
    {
        //
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        $data = $id;
        
        $pdf = PDF::loadView('order-material.print', compact('data'));
        return $pdf->download($id.'pdfview.pdf');
    }
}

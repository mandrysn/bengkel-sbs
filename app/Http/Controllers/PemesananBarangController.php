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
        $route  = 'order-barang';
        $title  = 'Pemesanan Barang';
        $order  = PoTransaksi::where('po_transaksi', 'LIKE', '%-PO/SO%')->orderby('created_at', 'asc')->paginate(20);
        
        return view('order-barang.index', compact('title', 'order', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route   = 'order-barang';
        $title   = 'Tambah Pemesanan Barang';
        
        $suplier = Suplier::pluck('nama_suplier', 'id')->all();
        $barang      = Barang::pluck('nama_barang', 'id')->all();
        // $sotransaksi = PoTransaksi::whereNull('po_transaksi')->pluck('no_transaksi', 'id')->all();
        
        $cari   = PoTransaksi::where('po_transaksi', 'LIKE', '%SBS' . date('Y') . '-PO/SO%')->get()->count();
        if ($cari < 1 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
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
            'tanggal_masuk'   => 'required',
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
        $route  = 'order-barang';
        $title  = 'Tambah Pemesanan Barang';
        $button = 'Tambah';
        $controller = 'PemesananBarangController';
        
        $order = PoTransaksi::findOrFail($id);
        $order_barang = PoTransaksiBarang::where('po_transaksi_id', $id)
                                            ->get();

        $suplier = Suplier::pluck('nama_suplier', 'id')->all();
        // $barang      = Barang::pluck('nama_barang', 'id')->all();
        $barang = SoTransaksiBarang::whereNotNull('harga_transaksi')
                            ->whereNotExists(function($query) {
                                $query->selectRaw('po_transaksi_barangs.so_transaksi_barang_id')
                                    ->from('po_transaksi_barangs')
                                    ->whereRaw('so_transaksi_barangs.id = po_transaksi_barangs.so_transaksi_barang_id');
                            })
                            ->orWhere('quantity_po', '>', 0)
                            
                            ->get();


        return view('order-barang.edit', compact('title', 'controller', 'route', 'order', 'button', 'suplier', 'order_barang', 'barang'));
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
            'quantity_po' => 'required'
        ]);

        $sotransaksi = SoTransaksiBarang::findOrFail($request->id);

        if ($request->quantity_po > $sotransaksi->quantity_po ) {
            $info = "warning";
            $pesan = "Gagal, Jumlah yang dimasukkan melebihi Jumlah yang dipesan, barang yang tersisa adalah <strong>" . $sotransaksi->quantity_po . " " . $sotransaksi->barang->satuan->nama_satuan . "</strong>";
        } else {

            $po = PoTransaksiBarang::firstOrCreate([
                'po_transaksi_id' => $id,
                'so_transaksi_barang_id'      => $request->id,
                'po_quantity'       => $request->quantity_po
            ]);
            
            $sotransaksi->quantity_po -= $request->quantity_po;
            $sotransaksi->update();

            $info = "success";
            $pesan = "Berhasil, memperbarui data Order <strong> " . $sotransaksi->barang->nama_barang . ", tersisa " . $sotransaksi->quantity_po . " " . $sotransaksi->barang->satuan->nama_satuan . "</strong>";
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
        
        $pdf = PDF::loadView('order-barang.print', compact('data'));
        return $pdf->download($id . 'pdfview.pdf');
    }
}

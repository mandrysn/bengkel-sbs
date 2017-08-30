<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Gudang;
use App\SoTransaksi;
use App\SoTransaksiBarang;
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
        $route  = 'barang-masuk';
        $title  = 'Barang Masuk';
        $order   = SoTransaksi::whereNotNull('bm_transaksi')->orderby('created_at', 'asc')->paginate(20);

        return view('barang-masuk.index', compact('title', 'order', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route   = 'barang-masuk';
        $title   = 'Tambah Barang Masuk';

        $notransaksi = SoTransaksi::whereNull('bm_transaksi')
                                    ->whereNotNull('po_transaksi')
                                    ->where('status_transaksi', 1)
                                    ->pluck('po_transaksi', 'id')
                                    ->all();
        // $notransaksi = SoTransaksi::whereNotNull('po_transaksi')
        //                             ->whereNotExists(function($query) {
        //                                 $query->selectRaw('barang_masuks.so_transaksi_id')
        //                                     ->from('barang_masuks')
        //                                     ->whereRaw('so_transaksis.id = barang_masuks.so_transaksi_id');
        //                             })
        //                             ->pluck('po_transaksi', 'id')
        //                             ->all();

        $cari   = SoTransaksi::where('bm_transaksi', 'LIKE', '%SBS' . date('Y') . '-BBM%')->get()->count();
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
        $this->validate($request, [
            'id'           => 'required',
            'bm_transaksi' => 'required|unique:so_transaksis'
        ]);

        // insert-update multiple
        // $sob = SoTransaksiBarang::where('so_transaksi_id', $request->id)->get();
        // foreach ($sob as $key => $data) {
        //     $save = Gudang::firstOrNew([
        //         'barang_id' => $data->barang_id
        //     ]);
        //     $save->jumlah += $data->quantity;
        //     $save->save();
        // }
        
        $order = SoTransaksi::findOrFail($request->id);
        $order->bm_transaksi = $request->bm_transaksi;
        $order->update();

        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data BBM <strong>$order->bm_transaksi</strong>"
        ]);

        return redirect('barang-masuk/' . $order->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $bbm   = SoTransaksi::findOrFail($id);
        // $dbm   = SoTransaksiBarang::where('barang_masuk_id', $bbm->id);
        $sot   = SoTransaksi::where('id', $bbm->so_transaksi_id);
        $sob   = SoTransaksiBarang::where('so_transaksi_id', $id)->get();
        
        $title = 'Detail: No. ' . $sot->no_transaksi;
        $route = 'barang-masuk';
        
        return view('barang-masuk.show', compact('title', 'route', 'sot', 'sob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route  = 'barang-masuk';
        $title  = 'Edit Bukti Barang Masuk';
        $button = 'Tambah';
        $controller = 'BarangMasukDetailController';
        
        $sot = SoTransaksi::findOrFail($id);
        $dbm = SoTransaksiBarang::where('so_transaksi_id', $sot->id)->get();


        return view('barang-masuk.edit', compact('title', 'controller', 'route', 'button', 'sot', 'dbm'));
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
        //
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

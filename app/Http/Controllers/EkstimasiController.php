<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoTransaksi;
use App\SoTransaksiBarang;
use App\SoTransaksiJasa;
use App\SoPelanggan;
use App\SoKendaraan;
use Session;

class EkstimasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route     = 'ekstimasi';
        $title     = 'Ekstimasi';
        $ekstimasi = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')->orderby('created_at', 'asc')->paginate(20);
        
        return view('ekstimasi.index', compact('title', 'ekstimasi', 'route'));
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
        $title     = 'Ubah Ekstimasi';
        $button    = 'Perbarui';
        $route     = 'ekstimasi';

        $ekstimasi = SoTransaksi::findOrFail($id);
        $detail_barang   = SoTransaksiBarang::where('so_transaksi_id', $id)->get();
        $detail_jasa     = SoTransaksiJasa::where('so_transaksi_id', $id)->get();
        $count_jasa    = SoTransaksiJasa::where('so_transaksi_id', $id)->count();
        $count_barang  = SoTransaksiBarang::where('so_transaksi_id', $id)->count();
        
        
        return view('ekstimasi.edit', compact('title', 'ekstimasi', 'route', 'button', 'detail_barang', 'detail_jasa', 'count_jasa', 'count_barang'));
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
        
    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function cari(Request $request)
     {
         $kata_kunci = $request->kata_kunci;
         $title = 'Ekstimasi - Pencarian ' . $kata_kunci;
         $route = 'ekstimasi';
         
         $ekstimasi = SoTransaksi::where('no_so_transaksi', 'LIKE', '%' . $kata_kunci . '%')
                       ->orderBy('no_so_transaksi', 'asc')
                       ->paginate(20);
 
         return view('ekstimasi.index', compact('title', 'ekstimasi', 'route'));
     }
}

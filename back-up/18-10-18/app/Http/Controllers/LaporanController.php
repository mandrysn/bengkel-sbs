<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;
use App\Merek;
use App\Asuransi;
use App\Suplier;
use App\Barang;
use App\SoTransaksi;
use App\SoKendaraan;
use App\Permission;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Laporan';
        $route = 'laporan';
        
        return view('laporan.index', compact('title', 'route'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfmerek()
    {
        $merek = Merek::orderby('nama_merek', 'asc')->get();
        
        $pdf = PDF::loadview('merek.rekap', compact('merek'));
        return $pdf->setPaper('a4', 'potrait')->download('REKAP-MEREK-KENDARAAN-SBS.pdf');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfbarang()
    {
        $barang = Barang::orderby('nama_barang', 'asc')->get();
        
        $pdf = PDF::loadview('barang.rekap', compact('barang'));
        return $pdf->setPaper('a4', 'landscape')->download('REKAP-BARANG-SBS.pdf');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfsuplier()
    {
        $suplier = Suplier::orderby('kode_suplier', 'asc')->get();
        
        $pdf = PDF::loadview('suplier.rekap', compact('suplier'));
        return $pdf->setPaper('a4', 'potrait')->download('REKAP-SUPPLIER-SBS.pdf');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfasuransi()
    {
        $asuransi = Asuransi::orderby('kode_asuransi', 'asc')->get();
        
        $pdf = PDF::loadview('asuransi.rekap', compact('asuransi'));
        return $pdf->setPaper('a4', 'potrait')->download('REKAP-ASURANSI-SBS.pdf');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfpelanggan()
    {
        $sot = SoKendaraan::orderby('so_pelanggan_id', 'asc')->get();
        
        $pdf = PDF::loadview('pelanggan.rekap', compact('sot'));
        return $pdf->setPaper('a4', 'landscape')->download('REKAP-PELANGGAN-SBS.pdf');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfkendaraan()
    {
        $sot = SoKendaraan::orderby('so_pelanggan_id', 'asc')->get();
        
        $pdf = PDF::loadview('kendaraan.rekap', compact('sot'));
        return $pdf->setPaper('a4', 'landscape')->download('REKAP-KENDARAAN-SBS.pdf');
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
        //
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

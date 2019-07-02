<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Pemasukan;
use App\Pengeluaran;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
	
	$route = 'saldo';
	$title = 'Saldo';
	
	$pemasukan = Pemasukan::orderby('tanggal_masuk', 'asc')->get();
	$pengeluaran = Pengeluaran::orderby('tanggal_masuk', 'asc')->get();
	
	$total_pemasukan = 0;
	$jumlah_pemasukan = 0;
		foreach($pemasukan as $pemasukans) {
			$jumlah_pemasukan = $pemasukans->jumlah_bayar;
			$total_pemasukan += $jumlah_pemasukan;
		}
		$a = $total_pemasukan;
		
	$total_pengeluaran = 0;
	$jumlah_pengeluaran = 0;
		foreach($pengeluaran as $pengeluarans) {
			$jumlah_pengeluaran = $pengeluarans->total_pengeluaran;
			$total_pengeluaran += $jumlah_pengeluaran;
		}
		$b = $total_pengeluaran;
		
        return view('keuangan.saldo.index', compact('title', 'a', 'b'));
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

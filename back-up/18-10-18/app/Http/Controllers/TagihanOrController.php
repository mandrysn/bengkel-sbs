<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Tagihan;
use App\SoTransaksi;
use App\SoPelanggan;
use App\SoTransaksiBarang;
use App\SoTransaksiJasa;
use App\Permission;
use Auth;
use Illuminate\Http\Request;

class TagihanOrController extends Controller
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

        $title    = 'Tagihan OR';
        $route = 'tagihan-or';
        $cari = 'cari-tagihan-or';
        $tagihans = Tagihan::where('deleted', 'N')->whereNotNull('jumlah_or')->orderby('tanggal_masuk', 'asc')->paginate(20);
        
        return view($route.'.index', compact('title', 'route', 'cari', 'tagihans'));
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

        $title       = 'Tambah Tagihan OR';
        $button      = 'Tambah';
        $route       = 'tagihan-or';
        
        $cari   = Tagihan::where('deleted', 'N')->orderby('id', 'desc')->first();
        $nol = substr($cari->kode_tagihan, -4);
        if($nol == '0000' ) {
            $add = 1;
        } else {
            $add = $nol + 1;
        }
        $kode   = 'SBS' . date('Y') . '-IN' . sprintf("%04s", $add);

        $transaksi = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')
                            ->where('status', '2')
                            ->whereNotNull('tanggal_invoice')
							->whereNotExists(function($query) {
                                    $query->selectRaw('tagihans.so_transaksi_id')
                                            ->from('tagihans')
											->where('tagihans.deleted', 'N')
                                            ->whereRaw('tagihans.so_transaksi_id = so_transaksis.id');
                                    })
                                    ->get();
        
        return view('template.create', compact('title', 'button', 'route', 'kode', 'transaksi'));
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
            'so_transaksi_id'      => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_or'     => 'required'
        ]);
		
        $cek = Tagihan::where('so_transaksi_id', $request->so_transaksi_id)->first();
        $data = SoTransaksi::findOrFail($request->so_transaksi_id);

        $detail_barang = SoTransaksiBarang::where('so_transaksi_id', $request->so_transaksi_id)->where('kategori_transaksi', 2)->get();
        $tagihan_barang = 0;
        $total_barang = 0;
        foreach($detail_barang as $datab) {
            $tagihan_barang = ( $datab->harga_transaksi - ($datab->harga_transaksi * $datab->diskon / 100) ) * $datab->quantity;
            $total_barang += $tagihan_barang;
        }
        $totalb = $total_barang;

        $detail_jasa = SoTransaksiJasa::where('so_transaksi_id', $request->so_transaksi_id)->get();
        $tagihan_jasa = 0;
        $total_jasa = 0;
        foreach($detail_jasa as $dataj) {
            $tagihan_jasa = ( $dataj->harga_transaksi - ($dataj->harga_transaksi * $dataj->diskon / 100) ) * $dataj->quantity;
            $total_jasa += $tagihan_jasa;
        }
        $totalj = $total_jasa;

        $detail_material = SoTransaksiBarang::where('so_transaksi_id', $request->so_transaksi_id)->where('kategori_transaksi', 1)->get();
        $tagihan_material = 0;
        $total_material = 0;
        foreach($detail_material as $datam) {
            $tagihan_material = ( $datam->harga_transaksi - ($datam->harga_transaksi * $datam->diskon / 100) ) * $datam->quantity;
            $total_material += $tagihan_material;
        }
        $totalm = $total_material;

        $total_tagihan = ($totalb + $totalj + $totalm) + ( ($data->ppn / 100) * ($totalb + $totalj + $totalm) );

			if ($cek === NULL) {
				
                Tagihan::firstOrCreate([
                    'kode_tagihan'  => $request->kode_tagihan,
                    'so_transaksi_id'      => $request->so_transaksi_id,
                    'tanggal_masuk'      => $request->tanggal_masuk,
                    'tagihan'    => $total_tagihan,
                    'pajak'     => '0',
                    'diskon'    => '0',
                    'jumlah_or' => $request->jumlah_or
                ]);

			} else {

                $record = Tagihan::findOrFail($cek->id);
                $record->jumlah_or = $request->jumlah_or;
                $record->tagihan = $total_tagihan;
				$record->tanggal_masuk = $request->tanggal_masuk;
				$record->deleted = 'N';
                $record->update();
                
			}
			
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan Tagihan OR <strong>$request->kode_tagihan</strong>"
        ]);

        return \Redirect::route('tagihan-or.index');
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

        $route      = 'tagihan-or';
        $controller = 'TagihanOrController';
        $title      = 'Ubah Tagihan';
        $button     = 'Perbarui';
            
        $data       = Tagihan::findOrFail($id);
        $kode = $data->kode_tagihan;
        
        return view($route.'.edit', compact('title', 'data', 'button', 'kode', 'route', 'controller'));
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
            'jumlah_or'    => 'required',
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->jumlah_or = $request->jumlah_or;
        $tagihan->update();
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data tagihan <strong>$tagihan->kode_tagihan</strong>"
            ]);
        
        return \Redirect::route('tagihan-or.index');
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

        $order = Tagihan::findOrFail($id);
		$order->deleted = 'Y';
        $order->update();

        return \Redirect::route('tagihan-or.index');
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

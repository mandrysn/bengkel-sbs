<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use PDF;
use Illuminate\Http\Request;
use App\SoTransaksi;
use App\SoPelanggan;
use App\Tagihan;
use App\Asuransi;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;
use App\Permission;
use App\Pemasukan;

class TagihanController extends Controller
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

        $title    = 'Invoice';
        $route = 'tagihan';
        $cari = 'cari-invoice';

        $tagihans = Tagihan::where('deleted', 'N')->orderby('tanggal_masuk', 'desc')->paginate(20);
		$asuransi  = Asuransi::where('deleted', 'N')->pluck('nama_asuransi', 'id')->all();

        return view($route . '.index', compact('title', 'asuransi', 'route', 'cari', 'tagihans'));
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

        $title       = 'Tambah Invoice';
        $button      = 'Tambah';
        $route       = 'tagihan';
        
        $cari   = Tagihan::where('deleted', 'N')->orderby('id', 'desc')->first();
        $nol = substr($cari->kode_tagihan, -4);
        if($nol == '0000' ) {
            $add = 1;
        } else {
            $add = substr($nol, -4) + 1;
        }
        $kode   = 'SBS' . date('Y') . '-IN' . sprintf("%04s", $add);

        $transaksi = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')
                            ->where('status', '2')
                            ->whereNotNull('tanggal_invoice')
							->whereNotExists(function($query) {
                                    $query->selectRaw('tagihans.so_transaksi_id')
                                            ->from('tagihans')
											->where('tagihans.deleted', 'N')
                                            ->whereRaw('so_transaksis.id = tagihans.so_transaksi_id');
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
            'kode_tagihan'         => 'required',
            'so_transaksi_id'      => 'required',
            'tanggal_masuk' => 'required'
        ]);

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

            $cek = Tagihan::where('so_transaksi_id', $request->so_transaksi_id)->first();
            if ($cek === NULL) {
                $tagihan_id = Tagihan::firstOrCreate([
                    'kode_tagihan'  => $request->kode_tagihan,
                    'so_transaksi_id'      => $request->so_transaksi_id,
                    'tanggal_masuk'      => $request->tanggal_masuk,
                    'pajak'     => '0',
                    'diskon'    => '0',
                    'tagihan' => $total_tagihan
                ]);
				
			$sid = Tagihan::findOrFail($tagihan_id->id);
			$sid->sid = $tagihan_id->id;
			$sid->update();
			
            } else {
                 $record = Tagihan::findOrFail($cek->id);
                 $record->tagihan = $total_tagihan;
			 	$record->tanggal_masuk = $request->tanggal_masuk;
			 	$record->deleted = 'N';
                 $record->update();
            }

			
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan Tagihan Invoice <strong>$request->kode_tagihan</strong>"
        ]);

        return \Redirect::route('tagihan.index');
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

        $data       = Tagihan::findOrFail($id);

        $route      = 'tagihan';
        $controller = 'TagihanController';
        $title      = 'Detail Invoice ' . $data->sotransaksi->sokendaraan->no_polisi;
            

        $detail_barang = SoTransaksiBarang::where('so_transaksi_id', $data->so_transaksi_id)->where('kategori_transaksi', 2)->get();
        $tagihan_barang = 0;
        $total_barang = 0;
        foreach($detail_barang as $datab) {
            $tagihan_barang = ( $datab->harga_transaksi - ($datab->harga_transaksi * $datab->diskon / 100) ) * $datab->quantity;
            $total_barang += $tagihan_barang;
        }
        $totalb = $total_barang;

        $detail_jasa = SoTransaksiJasa::where('so_transaksi_id', $data->so_transaksi_id)->get();
        $tagihan_jasa = 0;
        $total_jasa = 0;
        foreach($detail_jasa as $dataj) {
            $tagihan_jasa = ( $dataj->harga_transaksi - ($dataj->harga_transaksi * $dataj->diskon / 100) ) * $dataj->quantity;
            $total_jasa += $tagihan_jasa;
        }
        $totalj = $total_jasa;

        $detail_material = SoTransaksiBarang::where('so_transaksi_id', $data->so_transaksi_id)->where('kategori_transaksi', 1)->get();
        $tagihan_material = 0;
        $total_material = 0;
        foreach($detail_material as $datam) {
            $tagihan_material = ( $datam->harga_transaksi - ($datam->harga_transaksi * $datam->diskon / 100) ) * $datam->quantity;
            $total_material += $tagihan_material;
        }
        $totalm = $total_material;  
        
        return view($route . '.show', compact('title', 'data', 'totalj', 'totalb', 'route', 'totalm'));
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

        $route      = 'tagihan';
        $controller = 'TagihanController';
        $title      = 'Ubah Invoice';
        $button     = 'Perbarui';
            
        $data       = Tagihan::findOrFail($id);

        $detail_barang = SoTransaksiBarang::where('so_transaksi_id', $data->so_transaksi_id)->where('kategori_transaksi', 2)->get();
        $tagihan_barang = 0;
        $total_barang = 0;
        foreach($detail_barang as $datab) {
            $tagihan_barang = ( $datab->harga_transaksi - ($datab->harga_transaksi * $datab->diskon / 100) ) * $datab->quantity;
            $total_barang += $tagihan_barang;
        }
        $totalb = $total_barang;

        $detail_jasa = SoTransaksiJasa::where('so_transaksi_id', $data->so_transaksi_id)->get();
        $tagihan_jasa = 0;
        $total_jasa = 0;
        foreach($detail_jasa as $dataj) {
            $tagihan_jasa = ( $dataj->harga_transaksi - ($dataj->harga_transaksi * $dataj->diskon / 100) ) * $dataj->quantity;
            $total_jasa += $tagihan_jasa;
        }
        $totalj = $total_jasa;

        $detail_material = SoTransaksiBarang::where('so_transaksi_id', $data->so_transaksi_id)->where('kategori_transaksi', 1)->get();
        $tagihan_material = 0;
        $total_material = 0;
        foreach($detail_material as $datam) {
            $tagihan_material = ( $datam->harga_transaksi - ($datam->harga_transaksi * $datam->diskon / 100) ) * $datam->quantity;
            $total_material += $tagihan_material;
        }
        $totalm = $total_material;        

        return view($route.'.edit', compact('title', 'data', 'button', 'totalb', 'totalj', 'totalm', 'route', 'controller'));
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
            'pajak' => 'required',
            'diskon' => 'required'
        ]);
        
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->pajak = $request->pajak;
        $tagihan->diskon = $request->diskon;
        $tagihan->update();

        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data tagihan <strong>$request->kode_tagihan</strong>"
            ]);
        
            return redirect('tagihan/'.$id.'/edit');
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
		
		$cek = Pemasukan::where('tagihan_id', $id)->count();
        if ($cek > 0) {
            return "<script language='javascript'>
                    alert('Data ini telah dimasukan ke Pemasukan. Silahkan dihapus terlebih dahulu.');
                    history.back();
                    </script>";
        } else {
            $order = Tagihan::findOrFail($id);
            $order->deleted = 'Y';
            $order->update();
        }

        return \Redirect::route('tagihan.index');
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

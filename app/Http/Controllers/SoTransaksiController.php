<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SoPelanggan;
use App\SoKendaraan;
use App\SoTransaksi;
use App\SoTransaksiJasa;
use App\SoTransaksiBarang;
use App\Asuransi;
use App\Barang;
use App\Satuan;
use App\Suplier;
use App\Merek;
use Session;
use Storage;

class SoTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Servis Order';
        $route = 'servis-order';
        
        $sot   = SoTransaksi::where('no_transaksi', 'LIKE', '%-SO%')->orderby('created_at', 'asc')->paginate(20);
        
        return view('servis-order.index', compact('title', 'sot', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title     = 'Tambah Servis Order';
        $button    = 'Selanjutnya';
        $route     = 'servis-order';

        $result      = Merek::orderBy('id', 'ASC')->get();
        $merek       = [];
        foreach ( $result as $v ) {
            if ( !isset($merek[$v->nama_merek]) ) {
                $merek[$v->nama_merek] = [];
            }
            $merek[$v->nama_merek][$v->id] = $v->unit_merek;
            $bid[$v->nama_merek][$v->id] = $v->id;
        }
        
        $asuransi  = Asuransi::pluck('nama_asuransi', 'id')->all();
        
        return view('servis-order.create', compact('title', 'asuransi', 'barang', 'merek', 'button', 'route'));
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
            'asuransi_id'    => 'required',
            'no_claim'       => 'required|unique:so_pelanggans',
            'nama_pelanggan' => 'required',
            'no_telpon_pelanggan' => 'required',
            'alamat_pelanggan'    => 'required',
            'no_claim'        => 'required',
            'no_polisi'       => 'required|max:10',
            'no_rangka'       => 'required|max:17',
            'no_mesin'        => 'required|max:15',
            'merek_id'        => 'required',
            'warna_kendaraan' => 'required',
            'tahun_kendaraan' => 'required|max:4',
            'km_kendaraan'    => 'required|max:9',
            'foto_kiri'       => 'required|image|mimes:jpeg,jpg,bmp,png',
            'foto_kanan'      => 'required|image|mimes:jpeg,jpg,bmp,png',
            'foto_depan'      => 'required|image|mimes:jpeg,jpg,bmp,png',
            'foto_belakang'   => 'required|image|mimes:jpeg,jpg,bmp,png',
            'tanggal_masuk'   => 'required',
            'tanggal_selesai' => 'required'
        ]);
        
        if ($request->hasFile('foto_kiri') && $request->hasFile('foto_kanan') && $request->hasFile('foto_depan') && $request->hasFile('foto_belakang')) {
            $gambar_kiri     = $request->file('foto_kiri');
            $gambar_kanan    = $request->file('foto_kanan');
            $gambar_depan    = $request->file('foto_depan');
            $gambar_belakang = $request->file('foto_belakang');
            
            $ext_kiri     = $gambar_kiri->getClientOriginalExtension();
            $ext_kanan    = $gambar_kanan->getClientOriginalExtension();
            $ext_depan    = $gambar_depan->getClientOriginalExtension();
            $ext_belakang = $gambar_belakang->getClientOriginalExtension();
            
            if ($request->file('foto_kiri')->isValid() && $request->file('foto_kanan')->isValid() && $request->file('foto_depan')->isValid() && $request->file('foto_belakang')->isValid()) {
                $gambar_kiri_name = "SO_kiri_" . $request->km_kendaraan . date('YmdHis') . ".$ext_kiri";
                $gambar_kanan_name = "SO_kanan_" . $request->km_kendaraan . date('YmdHis') . ".$ext_kanan";
                $gambar_depan_name = "SO_depan_" . $request->km_kendaraan . date('YmdHis') . ".$ext_depan";
                $gambar_belakang_name = "SO_belakang_" . $request->km_kendaraan . date('YmdHis') . ".$ext_belakang";
                
                $path_kiri = 'asset/order/kiri';
                $path_kanan = 'asset/order/kanan';
                $path_depan = 'asset/order/depan';
                $path_belakang = 'asset/order/belakang';
                
                $request->file('foto_kiri')->move($path_kiri, $gambar_kiri_name);
                $request->file('foto_kanan')->move($path_kanan, $gambar_kanan_name);
                $request->file('foto_depan')->move($path_depan, $gambar_depan_name);
                $request->file('foto_belakang')->move($path_belakang, $gambar_belakang_name);
                
            }
        }

        $cari   = SoTransaksi::where('no_transaksi', 'LIKE', '%SBS' . date('Y') . '-SO%')->get()->count();
        if($cari < 0 ) {
            $add = 1;
        } else {
            $add = $cari + 1;
        }
        $kode = 'SBS' . date('Y') . '-SO' . sprintf("%04s", $add);

        $transaksi = SoTransaksi::firstOrCreate([
            'no_transaksi'     => $kode,
            'tanggal_masuk'    => \Carbon\Carbon::now()
        ]);

        $pelanggan = SoPelanggan::firstOrNew([
            'asuransi_id'         => $request->asuransi_id,
            'no_claim'            => $request->no_claim,
            'nama_pelanggan'      => $request->nama_pelanggan,
            'alamat_pelanggan'    => $request->alamat_pelanggan,
            'no_telpon_pelanggan' => $request->no_telpon_pelanggan
        ]);
        $transaksi->sopelanggan()->save($pelanggan);

        $kendaraan = SoKendaraan::firstOrNew([
            'no_polisi'       => $request->no_polisi,
            'no_rangka'       => $request->no_rangka,
            'no_mesin'        => $request->no_mesin,
            'merek_id'        => $request->merek_id,
            'warna_kendaraan' => $request->warna_kendaraan,
            'tahun_kendaraan' => $request->tahun_kendaraan,
            'km_kendaraan'    => $request->km_kendaraan,
            'foto_depan'      => $gambar_depan_name,
            'foto_belakang'   => $gambar_belakang_name,
            'foto_kanan'      => $gambar_kanan_name,
            'foto_kiri'       => $gambar_kiri_name,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
        $transaksi->sokendaraan()->save($kendaraan);
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Masukkan transaksi untuk Nomor: <strong>$request->no_claim</strong>"
        ]);

        return redirect('servis-order/'. $transaksi->id .'/edit/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sot   = SoTransaksi::findOrFail($id);
        $sob   = SoTransaksiBarang::where('so_transaksi_id', $id)->get();
        $soj   = SoTransaksiJasa::where('so_transaksi_id', $id)->get();
        
        $title = 'Detail: No. ' . $sot->no_transaksi;
        $route = 'servis-order';
        
        return view('servis-order.show', compact('title', 'sot', 'route', 'sob', 'soj'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route  = 'servis-order';
        $title  = 'Tambah Transaksi Servis Order';
        $button = 'Tambah';
        $controller = 'SoTransaksiController';
        
        $barang = Barang::where('kategori_barang', '2')
                        ->get();
        $transaksi = SoTransaksi::findOrFail($id);
        
        $tbarang = SoTransaksiBarang::where('so_transaksi_id', $id)->get();
        $tjasa   = SoTransaksiJasa::where('so_transaksi_id', $id)->get();
        $cjasa   = SoTransaksiJasa::where('so_transaksi_id', $id)->count();
        $cbarang = SoTransaksiBarang::where('so_transaksi_id', $id)->count();
        
        return view('servis-order.edit', compact('title', 'controller', 'route', 'barang', 'transaksi', 'tbarang', 'tjasa', 'cjasa', 'cbarang', 'button'));
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
        if ( ! empty($request->kegiatan) ) {
            
            $this->validate($request, [
                'kegiatan'   => 'required',
                'quantity'   => 'required'
            ]);
            
            SoTransaksiJasa::firstOrCreate([
                'so_transaksi_id'    => $id,
                'kategori_transaksi' => '1',
                'kegiatan'           => $request->kegiatan,
                'quantity'           => $request->quantity,
                'keterangan_transaksi' => $request->keterangan_transaksi,
                'harga_transaksi'    => '0'
            ]);
            
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, menambah transaksi jasa servis order"
                ]);
        } else if ( ! empty($request->barang_id) ) {
            $this->validate($request, [
                'barang_id'  => 'required',
                'quantity'   => 'required'
            ]);
            
            $transaksi = SoTransaksiBarang::where('so_transaksi_id', $id)->where('barang_id', $request->barang_id)->first();

            if (SoTransaksiBarang::where('so_transaksi_id', $id)->where('barang_id', $request->barang_id)->get()->count() == 0) {
                SoTransaksiBarang::firstOrCreate([
                    'so_transaksi_id'    => $id,
                    'kategori_transaksi' => '2',
                    'barang_id'          => $request->barang_id,
                    'quantity'           => $request->quantity,
                    'quantity_po'           => $request->quantity,
                    'keterangan_transaksi'         => $request->keterangan_transaksi,
                    'harga_transaksi'    => '0'
                ]);
            } else {
                $transaksi_barang = SoTransaksiBarang::findOrFail($transaksi->id);
                $transaksi_barang->quantity += $request->quantity;
                $transaksi_barang->keterangan_transaksi = $request->keterangan_transaksi;
                $transaksi_barang->update();
            }
            
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-info",
                    "message"   => "Berhasil, menambah transaksi barang servis order"
                ]);
        }
        
        return redirect('servis-order/'. $id .'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $order = SoTransaksi::findOrFail($id);
        
        $exists_f  = Storage::disk('foto_depan')->exists($order->sokendaraan->foto_depan);
        $exists_b  = Storage::disk('foto_belakang')->exists($order->sokendaraan->foto_belakang);
        $exists_l  = Storage::disk('foto_kiri')->exists($order->sokendaraan->foto_kiri);
        $exists_r  = Storage::disk('foto_kanan')->exists($order->sokendaraan->foto_kanan);
        
        
        if (isset($order->sokendaraan->foto_depan) && $exists_f && isset($order->sokendaraan->foto_belakang) && $exists_b && isset($order->sokendaraan->foto_kiri) && $exists_l && isset($order->sokendaraan->foto_kanan) && $exists_r) {
            Storage::disk('foto_depan')->delete($order->sokendaraan->foto_depan);
            Storage::disk('foto_belakang')->delete($order->sokendaraan->foto_belakang);
            Storage::disk('foto_kiri')->delete($order->sokendaraan->foto_kiri);
            Storage::disk('foto_kanan')->delete($order->sokendaraan->foto_kanan);
               
            }
        
        $order->delete();
        $order->sokendaraan->delete();
        $order->sopelanggan->delete();
        $order->sotransaksijasa->delete();
        $order->sotransaksibarang->delete();

        return \Redirect::route('servis-order.index');
    }
}

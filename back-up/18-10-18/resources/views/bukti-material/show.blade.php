@extends('template.template')

@section('content')
<style type="text/css">
	#gambar{
		max-width: 100%;
	}
	@media screen and (max-width: 1199px) {
	  #gambar {
	   	float: none;
		margin-top: 5px;
		margin-bottom: 5px;
	  }
	}

</style>
            <h1 class="page-header">
                <img src="{{ asset('admin/images/inventory.png') }}" style="height:50px; width:90px; margin-top:-15px; margin-bottom:-10px;" title="logo sbs" alt="logo sbs">
                <span>Bukti Pengajuan Pembayaran Masuk</span>
            </h1>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="40%">Nomor Pemesanan Barang Masuk</th><td width="1%">:</td><td>{{ $sot->bbm_material }}</td></tr>
                    <tr><th>Nomor Pengajuan Pembayaran Transaksi</th><td>:</td><td>{{ $sot->material->ma_transaksi }}</td></tr>
                    <tr><th>Tanggal Pemesanan Datang</th><td>:</td><td>{{ $sot->tanggal_masuk }}</td></tr>
                </table>

                


            </div>
            
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Barang</th>
                                    <th>No. Part Barang</th>
                                    <th>Supplier</th>
                                    <th>Qty</th>
                                    <th>Harga (Rp)</th>
                                    <th>Diskon (%)</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php ($tagihan = 0)
                                    @php ($total = 0)
                                @foreach($dbm as $index => $data)
                                <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->barang->nama_barang }}</td>
                                        <td>{{ $data->barang->no_part_barang }}</td>
                                        <td>{{ $data->suplier->nama_suplier }}</td>
                                        <td>{{  $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                        <td>{{ number_format($data->harga_transaksi) }}</td>
                                        <td>{{ $data->diskon }}</td>
                                        <td>{{ number_format( $tagihan = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity) }}</td>
                                        <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan) }}</td>

                                </tr>
                                    
                                @endforeach
        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" align="right" valign="middle"><h5>total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format($total) }}</h5></td>
                                </tr>
                            </tfoot>
                        </table>
        
                        <p></p>
                        {!! Form::open(
                                        ['route' => ['print-bukti-material.store'], 
                                            'role'  => 'form',
                                            'method'=> 'post',
                                            'class' => 'form-inline']) !!}
                                             
                                        {{ Form::hidden('route', 'bukti-material') }}
                                        {{ Form::hidden('id', $sot->id) }}
                                        {!! Form::submit('Cetak', ['class' => 'btn btn btn-info ']) !!}
                                        <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                                    {!! Form::close() !!} 
@stop
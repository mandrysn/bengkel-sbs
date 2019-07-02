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
                <span>{{ $title }}</span>
            </h1>
            <div class="col-md-6">

                    <h3>Data Pemesanan</h3>

                <table class="table">
                    <tr><th width="30%">Nomor Pemesanan</th><td width="1%">:</td><td>{{ $transaksi->ma_transaksi }}</td></tr>
                    <tr><th>Tanggal Pemesanan</th><td>:</td><td>{{ $transaksi->tanggal_masuk }}</td></tr>
                    <tr><th>Supplier</th><td>:</td><td>{{ $transaksi->suplier->nama_suplier }}</td></tr>
                </table>

            </div>

	            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang / Kode</th>
                            <th>Nomor Part</th>
                            <th>Qty</th>
                            <th>Harga Beli (Rp)</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php ( $tagihan = 0 )
                        @php ( $total = 0 )

                        @foreach($ma as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->barang->no_part_barang }}</td>
                            <td width="15%">
                                {{ $data->ma_quantity }}
								{{ $data->barang->satuan->kode_satuan }}
                            </td>
                            <td align="right">{{ number_format($data->harga_transaksi) }}</td>
                            <td align="right">{{ number_format( $tagihan = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->ma_quantity ) }}</td>
                            <td width="15%">{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan) }}</td>
                        </tr>
                        
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="5" align="right" valign="middle"><h5>total (Rp)</h5></td>
                            <td align="right"><h5>{{ number_format($total) }}</h5></td>
                        </tr>
                    </tfoot>

                </table>
        
                <p></p>
                {!! Form::open(
                                ['route' => ['print-order-material.store'], 
                                    'role'  => 'form',
                                    'method'=> 'post',
                                    'class' => 'form-inline']) !!}
                                     
                                {{ Form::hidden('route', 'order-material') }}
								{{ Form::hidden('id', $transaksi->id) }}
                                {!! Form::submit('Cetak', ['class' => 'btn btn btn-info ']) !!}
								<a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                            {!! Form::close() !!}	 
	
                

            
@stop
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
                <span margin>{{ $title }}</span>
            </h1>
            <div class="col-md-6">

                    <h3>Data Pemesanan</h3>

                <table class="table">
                    <tr><th width="30%">Nomor Pemesanan</th><td width="1%">:</td><td>{{ $sot->po_transaksi }}</td></tr>
                    <tr><th>Tanggal Pemesanan</th><td>:</td><td>{{ $sot->tanggal_masuk }}</td></tr>
                    <tr><th>Supplier</th><td>:</td><td>{{ $sot->suplier->nama_suplier }}</td></tr>
                </table>

            </div>

            <div class="col-md-6">

                    <h3>Data Pemesan</h3>

                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Invoice</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nomor Polisi</th>
                                    <th>Barang Dipesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($order_barang as $index => $data)
                                
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $data->sotransaksibarang->sotransaksi->no_transaksi }}</td>
                                    <td>{{ $data->sotransaksibarang->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                                    <td>{{ $data->sotransaksibarang->sotransaksi->sokendaraan->no_polisi }}</td>
                                    <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                                    
                                </tr>
                                
                                @endforeach
        
                        </table>

            </div>

	            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang / Kode</th>
                            <th>Kode Part</th>
                            <th>Qty</th>
                            <th>Harga (Rp)</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ( $tagihan = 0 )
                        @php ( $total = 0 )
                        @foreach($order_barang as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>[ {{ $data->sotransaksibarang->sotransaksi->no_transaksi }} ]</strong> {{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->barang->no_part_barang }}</td>
                            <td width="15%">{{ $data->po_quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                            <td>{{ number_format($data->sotransaksibarang->barang->harga_beli) }}</td>
                            <td>{{ $data->diskon }} %</td>
                            <td align="right">{{ number_format( $tagihan = ( $data->sotransaksibarang->barang->harga_beli - ($data->sotransaksibarang->barang->harga_beli * $data->diskon / 100) ) * $data->po_quantity ) }}</td>
                            <td width="15%">{{ $data->sotransaksibarang->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan) }}</td>
                            
                        </tr>
                        
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" align="right" valign="middle"><h5>total (Rp)</h5></td>
                            <td align="right"><h5>{{ number_format($total) }}</h5></td>
                        </tr>
                    </tfoot>
                </table>

                
                <p></p>
                <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                <a href="{{ URL($route . '/' . $sot->id . '/pdfview') }}" class="btn btn-info">Cetak</a>  
	
                

            
@stop
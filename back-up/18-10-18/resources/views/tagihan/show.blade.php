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
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="30%">Kode Tagihan</th><td width="1%">:</td><td>{{ $data->kode_tagihan }}</td></tr>
					<tr><th>Nama Pelanggan</th><td width="1%">:</td><td>{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
					<tr><th>Asuransi</th><td>:</td><td>{{ $data->sotransaksi->asuransi_id == '0' ? $data->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $data->sotransaksi->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $data->sotransaksi->sokendaraan->sopelanggan->no_claim }}</td></tr>
					<tr><th>No. Polisi</th><td>:</td><td>{{ $data->sotransaksi->sokendaraan->no_polisi }}</td></tr>
					<tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $data->sotransaksi->sokendaraan->no_mesin }} / {{ $data->sotransaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}</td></tr>
					<tr><th>Tanggal Masuk</th><td>:</td><td>{{ $data->tanggal_masuk }}</td></tr>
                </table>

                
                {!! Form::open(
                    ['route' => ['print-invoice.store'], 
                    'role'  => 'form',
                    'method'=> 'post',
                    'class' => 'form-inline']) !!}
                     
                     
                     {{ Form::hidden('route', 'invoice') }}
                {{ Form::hidden('id', $data->id) }}
                {!! Form::submit('Cetak', ['class' => 'btn btn btn-info ']) !!}
				<a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                {!! Form::close() !!} 
                
            </div>
            
            <div class="col-md-6">
                
                    <h2>Detail Tagihan</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Deskripsi</th>
                            <th>Amount (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jasa</td>
                            <td>{{ number_format($totalj) }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sparepart</td>
                            <td>{{ number_format($totalb) }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Material</td>
                            <td>{{ number_format($totalm) }}</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&#8212; PPn (%)</th>
                            <th>{{ $data->sotransaksi->ppn == null ? "0" : $data->sotransaksi->ppn }} %</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&#8212; Sub Total</th>
                            <th>{{ number_format( $jumlah = ($totalj + $totalb + $totalm) + ( ($data->sotransaksi->ppn / 100) * ($totalj + $totalb + $totalm) ) ) }}</th>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pajak</td>
                            <td>{{ number_format($data->pajak) }} %</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Diskon</td>
                            <td>{{ number_format($data->diskon) }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <th><font size="3">&#8212; Total</font></th>
                            <th><font size="3">{{ number_format( ($jumlah) + ( ($jumlah) * ($data->pajak / 100) ) - $data->diskon ) }}</font></th>
                        </tr>


                    </tbody>
                </table>
	
            </div>
			
            
@stop
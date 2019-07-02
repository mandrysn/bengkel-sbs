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
                <span>Unit Lapor {{ $title }}</span>
            </h1>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $transaksi->asuransi_id == '0' ? $transaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $transaksi->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->no_claim }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Kendaraan</h2>

                <table class="table">
                    <tr><th width="25%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->no_polisi }} / {{ $transaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $transaksi->sokendaraan->no_mesin }} / {{ $transaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $transaksi->sokendaraan->merek->nama_merek }} / {{ $transaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->warna_kendaraan }}</td></tr>
                </table>

            </div>

            <div class="col-md-6">
			<h2>Data Unit Lapor</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Keluhan</th>
                            <th>Perbaikan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pres as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->keluhan }}</td>
                            <td>{{ $data->perbaikan }}</td>
                            <td>{{ $data->keterangan }}</td>
                            
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

                <p></p>

							{!! Form::open(
                                ['route' => ['print-preso.store'], 
                                    'role'  => 'form',
                                    'method'=> 'post',
                                    'class' => 'form-inline']) !!}
                                     
                                {{ Form::hidden('route', 'pre-so') }}
								{{ Form::hidden('id', $transaksi->id) }}
                                {!! Form::submit('Cetak', ['class' => 'btn btn btn-info ']) !!}
								<a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                            {!! Form::close() !!}				
                
            </div>

@stop
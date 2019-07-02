@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <ul class="nav nav-tabs">
                    <li class="active"><a href="tagihan-or" id="so" data-toggle="tab">Tagihan OR</a></li>
                    <li><a href="{{ url('tagihan') }}" class="btn btn-primary">Invoice</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="tagihan-or">
                        <p></p>
                        <div style="float: left">
                            @include('template.form_pencarian')
                        </div>

            
                        <div style="float: right">
                            {!! Form::open(
                                ['route' => ['rekap-tagihan-or.store'], 
                                    'role'  => 'form',
                                    'method'=> 'post',
                                    'class' => 'form-inline']) !!}
                                     
                                {{ Form::hidden('route', 'tagihan-or') }}
                                {{ Form::date('tanggal_awal', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }} s/d
                                {{ Form::date('tanggal_akhir', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                                {!! Form::submit('Rekap', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </div>
            
                        <div style="clear: both"></div>
            <p></p>

            @include('template.notification')

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>Tanggal OR Masuk</th>
                        <th>No. Servis Order / No. Claim</th>
                        <th>Biaya</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihans as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($tagihans->CurrentPage() - 1) * $tagihans->PerPage() ) }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
                            <td>{{ $data->sotransaksi->no_transaksi }} / {{ $data->sotransaksi->sokendaraan->sopelanggan->no_claim }}</td>
                            <td>{{ number_format($data->jumlah_or) }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->sotransaksi->asuransi_id == '0' ? 'Tidak ada data' : $data->sotransaksi->asuransi->nama_asuransi }}</td>
                            <td>
                            {!! Form::open(['route' => [$route.'.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                {!! link_to_route($route.'.edit', ' Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}

                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}
                            {!! Form::close() !!}
							<br>
														{!! Form::open(
                                ['route' => ['print-tagihan-or.store'], 
                                    'role'  => 'form',
                                    'method'=> 'post',
                                    'class' => 'form-inline']) !!}
                                     
                                {{ Form::hidden('route', 'tagihan-or') }}
								{{ Form::hidden('id', $data->id) }}
                                {!! Form::submit('Cetak', ['class' => 'btn btn btn-info ']) !!}
                            {!! Form::close() !!}		</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>

            {{ $tagihans->links() }}
            
            <div class="tab-pane"></div>
    
        </div>
@stop
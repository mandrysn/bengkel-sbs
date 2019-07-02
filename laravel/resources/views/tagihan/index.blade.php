@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <ul class="nav nav-tabs">
                    <li><a href="{{ url('tagihan-or') }}" class="btn btn-primary">Tagihan OR</a></li>
                    <li class="active"><a href="tagihan" id="tagihan" data-toggle="tab">Invoice</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="tagihan">
                        <p></p>
                        <div style="float: left">
                            @include('template.form_pencarian')
                        </div>

            
                        <div style="float: right">
                            {!! Form::open(
                                ['route' => ['rekap-invoice.store'], 
                                    'role'  => 'form',
                                    'method'=> 'post',
                                    'class' => 'form-inline']) !!}
                                     
                                {{ Form::hidden('route', 'invoice') }}
								{{ Form::select('asuransi', $asuransi, null, ['class' => 'col-lg-3 form-control selectpicker', 'placeholder' => 'Pilih asuransi...', 'data-live-search' => 'true']) }}
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
                        <th>Tanggal Invoicec</th>
                        <th>No. Tagihan</th>
                        <th>Tagihan (Rp)</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihans as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($tagihans->CurrentPage() - 1) * $tagihans->PerPage() ) }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
                            <td>{{ $data->kode_tagihan }} / {{ $data->sotransaksi->no_transaksi }}</td>
                            <td>{{ number_format( $data->tagihan ) }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->sotransaksi->asuransi_id == '0' ? 'Tidak ada data' : $data->sotransaksi->asuransi->nama_asuransi }}</td>
                            <td>{{ is_null($data->jumlah_or) ? 'Belum Bayar' : 'Sudah Bayar' }}</td>
                            <td>
                                @include('template.aksi')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="tab-pane"></div>

            {{ $tagihans->links() }}

        </div>
@stop
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

            @include('template.form_pencarian')
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
                            <td>Rp {{ number_format($data->jumlah_or) }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td>
                            <td>
                            {!! Form::open(['route' => [$route.'.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                {!! link_to_route($route.'.edit', ' Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirmation();"]) !!}
                                <a href="{{ URL($route . '/' . $data->id . '/pdfview') }}" class="btn btn-success">Cetak</a>
                            {!! Form::close() !!}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>

            {{ $tagihans->links() }}
            
            <div class="tab-pane"></div>
    
        </div>
@stop
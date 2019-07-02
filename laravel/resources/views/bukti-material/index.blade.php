@extends('template.template')

@section('content')
<h1 class="page-header">Bukti Barang Masuk</h1>

            <ul class="nav nav-tabs">
                <li><a href="{{ url('barang-masuk') }}" class="btn btn-primary">Purchase Order</a></li>
                <li class="active"><a href="bukti-material"  id="so"  data-toggle="tab">Pengajuan Pembayaran</a></li>
            </ul>
            
            <div class="tab-content">
                
                <div class="tab-pane active" id="so">

                <h3 class="page-header">Pengajuan Pembayaran</h3>
                <div style="float: left">
                        @include('template.form_pencarian')
                    </div>

        
                    <div style="float: right">
                        {!! Form::open(
                            ['route' => ['rekap-bukti-material.store'], 
                                'role'  => 'form',
                                'method'=> 'post',
                                'class' => 'form-inline']) !!}
                                 
                            {{ Form::hidden('route', 'bukti-material') }}
                            {{ Form::date('tanggal_awal', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }} s/d
                            {{ Form::date('tanggal_akhir', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                            {!! Form::submit('Rekap', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
        
                    <div style="clear: both"></div>
            <p></p>
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="2%">No</th>
                    <th>No. Bukti Barang Masuk</th>
                    <th>No. Pengajuan Pembayaran</th>
                    <th>Tanggal Masuk</th>
                    <th>Total (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order->CurrentPage() - 1) * $order->PerPage() ) }}</td>
                        <th>{{ $data->bbm_material }}</th>
                        <td>{{ $data->material->ma_transaksi }}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>{{ number_format($data->total) }}</td>
                        <td>
                        @include('template.aksi')
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order->links() }}

@stop
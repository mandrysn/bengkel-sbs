@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <ul class="nav nav-tabs">
                <li><a href="{{ url('order-barang') }}" >Purchase Order</a></li>
                <li class="active"><a href="order-material" id="pb" data-toggle="tab">Pengajuan Pembayaran</a></li>
                </ul>

                <div class="tab-content">
                    
                        <div class="tab-pane active" id="pb">
                                <p></p>

            <div style="float: left">
                @include('template.form_pencarian')
            </div>


            <div style="float: right">
                {!! Form::open(
                    ['route' => ['rekap-order-material.store'], 
                        'role'  => 'form',
                        'method'=> 'post',
                        'class' => 'form-inline']) !!}
                         
                    {{ Form::hidden('route', 'order-material') }}
                    {{ Form::date('tanggal_awal', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }} s/d
                    {{ Form::date('tanggal_akhir', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                    {!! Form::submit('Rekap', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </div>

            <div style="clear: both"></div>

            <p></p>
            @include('template.notification')
            
            <p></p>
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="2%">No</th>
                    <th>No. Pengajuan Pembayaran</th>
                    <th>Supplier</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_material as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order_material->CurrentPage() - 1) * $order_material->PerPage() ) }}</td>
                        <th>{{ $data->ma_transaksi }}</th>
                        <td>{{ $data->suplier->nama_suplier}}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>{{ number_format($data->total) }}</td>
                        <td>
                                @include(
                                    'template.aksi'
                                )
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order_material->links() }}
    </div>

    <div class="tab-pane"></div>
    
</div>
@stop
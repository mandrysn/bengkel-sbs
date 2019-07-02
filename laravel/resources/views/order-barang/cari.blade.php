@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <ul class="nav nav-tabs">
                    <li class="active"><a href="purchase-order" id="po" data-toggle="tab">Purchase Order</a></li>
                    <li><a href="{{ url('order-material') }}" >Pengajuan Pembayaran</a></li>
                </ul>

                <div class="tab-content">
                    
                        <div class="tab-pane active" id="po">
                                <p></p>
                                
            <div style="float: left">
                    @include('template.form_pencarian')
                </div>
    
    
                <div style="float: right">
                    {!! Form::open(
                        ['route' => ['rekap-order-barang.store'], 
                            'role'  => 'form',
                            'method'=> 'post',
                            'class' => 'form-inline']) !!}
                             
                        {{ Form::hidden('route', 'order-barang') }}
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
                    <th>No. Pemesanan Barang</th>
                    <th>Supplier</th>
                    <th>Tanggal Masuk</th>
                    <th>Total (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php ($index = 1)
                @foreach ($order as $data)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <th>{{ $data->po_transaksi }}</th>
                        <td>{{ $data->suplier->nama_suplier }}</td>
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
        
    </div>

    <div class="tab-pane"></div>
    
</div>
@stop
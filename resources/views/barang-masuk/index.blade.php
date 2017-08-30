@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            @include('template.notification')
            
            <div class="row">
                <div class="col-lg-6">
                    @include('template.form_pencarian')

                </div>
            </div>
            <p></p>
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="2%">No</th>
                    <th>No. Bukti Barang Masuk</th>
                    <th>No. Purchase Order</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order->CurrentPage() - 1) * $order->PerPage() ) }}</td>
                        <th>{{ $data->bm_transaksi }}</th>
                        <td>{{ $data->po_transaksi }}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>
                        {!! Form::open(['route' => [$route.'.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            {!! link_to_route($route.'.edit', 'Detail', $data->id, ['class' => 'btn btn-primary'] ) !!}
                            
                            <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
                            
                        {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order->links() }}

@stop
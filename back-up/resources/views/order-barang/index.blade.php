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
                    <th>No. Pemesanan Barang</th>
                    <th>Supplier</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order->CurrentPage() - 1) * $order->PerPage() ) }}</td>
                        <th>{{ $data->po_transaksi }}</th>
                        <td>{{ $data->suplier->nama_suplier }}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>
                        {!! Form::open(['route' => ['order-barang.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                        {!! link_to_route($route.'.edit', 'Edit', $data->id, ['class' => 'btn btn-primary'] ) !!}
                            <a href="{{ URL($route . '/' . $data->id) }}" class="btn btn-success">Detail</a>
                            {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order->links() }}

@stop
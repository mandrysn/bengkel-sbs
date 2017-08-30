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
                    <th>No. Pemesanan Material</th>
                    <th>Supplier</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_material as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order_material->CurrentPage() - 1) * $order_material->PerPage() ) }}</td>
                        <th>{{ $data->po_transaksi }}</th>
                        <td>{{ $data->suplier->nama_suplier}}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>{{ $data->status_transaksi }}</td>
                        <td>
                        
                            {!! link_to_route($route.'.edit', 'Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
                            <a href="{{ URL($route . '/' . $data->id . '/pdfview') }}" class="btn btn-success">Cetak</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order_material->links() }}

@stop
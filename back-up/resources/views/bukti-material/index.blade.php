@extends('template.template')

@section('content')
<h1 class="page-header">Bukti Barang Masuk</h1>

            <ul class="nav nav-tabs">
                <li><a href="{{ url('barang-masuk') }}" class="btn btn-primary">Servis Order</a></li>
                <li class="active"><a href="bukti-material"  id="so"  data-toggle="tab">Keperluan Pribadi</a></li>
            </ul>
            
            <div class="tab-content">
                
                <div class="tab-pane active" id="so">

                <h3 class="page-header">Keperluan Kantor</h3>
        @include('template.form_pencarian')
        
        <p></p>

        @include('template.notification')
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
                        <th>{{ $data->bbm_material }}</th>
                        <td>{{ $data->material->ma_transaksi }}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>
                            {!! link_to_route($route.'.edit', 'Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
                            <a href="{{ URL($route . '/' . $data->id) }}" class="btn btn-success">Detail</a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order->links() }}

@stop
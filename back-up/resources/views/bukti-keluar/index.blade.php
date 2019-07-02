@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <ul class="nav nav-tabs">
                <li><a href="{{ url('barang-keluar') }}" class="btn btn-primary">Servis Order</a></li>
                    <li class="active"><a href="pre-so" id="so" data-toggle="tab">Keperluan Kantor</a></li>
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
                    <th>No. Bukti Barang Keluar</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order->CurrentPage() - 1) * $order->PerPage() ) }}</td>
                        <td>{{ $data->bbk_material }}</td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>
                            <a href="{{ URL($route . '/' . $data->id . '/edit') }}" class="btn btn-success">Ubah</a>
                            <a href="{{ URL($route . '/' . $data->id) }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order->links() }}

@stop
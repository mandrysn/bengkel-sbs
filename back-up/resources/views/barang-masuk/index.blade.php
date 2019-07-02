@extends('template.template')

@section('content')
            <h1 class="page-header">Bukti Barang Masuk</h1>

            <ul class="nav nav-tabs">
                <li class="active"><a href="pre-so" id="so" data-toggle="tab">Servis Order</a></li>
                <li><a href="{{ url('bukti-material') }}" class="btn btn-primary">Keperluan Pribadi</a></li>
            </ul>
            
            <div class="tab-content">
                
                <div class="tab-pane active" id="so">

                <h3 class="page-header">Servis Order</h3>
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
                        <th>{{ $data->bbm_transaksi }}</th>
                        <td>{{ $data->potransaksi->po_transaksi }}</td>
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
    </div>
        
    <div class="tab-pane"></div>
    
</div>
@stop
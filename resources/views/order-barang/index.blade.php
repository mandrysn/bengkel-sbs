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
                    <th>No. Servis Order</th>
                    <th>Nama Pelanggan</th>
                    <th>Merek / Type Kendaraan</th>
                    <th>Nomor Polisi</th>
                    <th>Asuransi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $index => $data)
                    <tr>
                        <td>{{ $index + 1 + ( ($order->CurrentPage() - 1) * $order->PerPage() ) }}</td>
                        <th>{{ $data->po_transaksi }}</th>
                        <td>{{ $data->sotransaksi->no_transaksi }}</td>
                        <td>{{ $data->sotransaksi->sopelanggan->nama_pelanggan }}</td>
                        <td>{{ $data->sotransaksi->sokendaraan->merek_kendaraan }} / {{ $data->sotransaksi->sokendaraan->type_kendaraan }}</td>
                        <td>{{ $data->sotransaksi->sokendaraan->no_polisi }}</td>
                        <td>{{ $data->sotransaksi->sopelanggan->asuransi->nama_asuransi }}</td>
                        <td>
                        {!! Form::open(['route' => [$route.'.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            {!! link_to_route($route.'.edit', 'Detail', $data->id, ['class' => 'btn btn-primary'] ) !!}
                            {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                        {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $order->links() }}

@stop
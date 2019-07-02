@extends('template.template')

@section('content')
            <h1 class="page-header">Transaksi Order</h1>
            
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('pre-so') }}" class="btn btn-primary">Pre SO</a></li>
                    <li class="active"><a href="servis-order" id="so" data-toggle="tab">SO</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="so">

                    <h3 class="page-header">{{ $title }}</h3>
            @include('template.form_pencarian')
            
            <p></p>

            @include('template.notification')

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>No. Servis Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th>Disetujui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sot as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($sot->CurrentPage() - 1) * $sot->PerPage() ) }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ $data->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sokendaraan->merek->nama_merek }} / {{ $data->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td>
                            <td>{{ $data->tanggal_so }}</td>
                            <td>
                                {!! Form::open(['route' => [$route.'.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                <a href="{{ URL($route . '/' . $data->id) }}" class="btn btn-success">Detail</a>
                                {!! link_to_route($route.'.edit', 'Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $sot->links() }}

        </div>
        
    <div class="tab-pane"></div>
    
</div>
@stop
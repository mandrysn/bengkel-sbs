@extends('template.template')

@section('content')
            <h1 class="page-header">Transaksi Order</h1>
            
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('pre-so') }}" class="btn btn-primary">Unit Lapor</a></li>
                    <li class="active"><a href="servis-order" id="so" data-toggle="tab">SPK</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="so">

                    <h3 class="page-header">{{ $title }}</h3>
                    <div style="float: left">
                        @include('template.form_pencarian')
                    </div>

        
                    <div style="float: right">
                        {!! Form::open(
                            ['route' => ['rekap-so.store'], 
                                'role'  => 'form',
                                'method'=> 'post',
                                'class' => 'form-inline']) !!}
                                 
                            {{ Form::hidden('route', 'so') }}
                            {{ Form::select('status_data', ['1' => 'In Progress', '2' => 'SPK'], null, ['class' => 'col-lg-3 form-control selectpicker', 'data-live-search' => 'false']) }}
                            {{ Form::date('tanggal_awal', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }} s/d
                            {{ Form::date('tanggal_akhir', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                            {!! Form::submit('Rekap', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
        
                    <div style="clear: both"></div>
            
            <p></p>

            @include('template.notification')

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>No. SPK</th>
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
                            <td>{{ $data->asuransi_id == '0' ? $data->sokendaraan->sopelanggan->asuransi->nama_asuransi : $data->asuransi->nama_asuransi }}</td>
                            <td>{{ $data->tanggal_so }}</td>
                            <td>
                                @include('template.aksi')
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
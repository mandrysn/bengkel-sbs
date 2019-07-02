@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <div style="float: left">
                    @include('template.form_pencarian')
                </div>

    
                <div style="float: right">
                    {!! Form::open(
                        ['route' => ['rekap-pre-invoice.store'], 
                            'role'  => 'form',
                            'method'=> 'post',
                            'class' => 'form-inline']) !!}
                             
                        {{ Form::hidden('route', 'pre-invoice') }}
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
                        <th>No. Pre Invoice</th>
                        <th>Tanggal Pre Invoice</th>
                        <th>Total Estimasi (Rp)</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php( $index = 1)
                    @foreach ($ekstimasi as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ $data->tanggal_invoice }}</td>
                            <td align="right">{{ number_format($data->jumlah_estimasi + ( ($data->ppn / 100) * ($data->jumlah_estimasi) )) }} Rp</td>
                            <td>{{ $data->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sokendaraan->merek->nama_merek }} / {{ $data->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->asuransi_id == '0' ? $data->sokendaraan->sopelanggan->asuransi->nama_asuransi : $data->asuransi->nama_asuransi }}</td>
                            <td>
{!! Form::open(['route' => [$route.'.destroy', $data->servis_order_id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
    {!! link_to_route($route.'.edit', ' Ubah', $data->servis_order_id, ['class' => 'btn btn-primary'] ) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}
	<a href="{{ URL($route . '/' . $data->servis_order_id) }}" class="btn btn-success">Detail</a>
{!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

@stop
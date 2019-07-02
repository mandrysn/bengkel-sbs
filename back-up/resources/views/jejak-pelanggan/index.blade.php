@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <div style="float: left">
            {!! Form::open(['url' => $route.'/cari', 'method' => 'GET', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci']) !!}
                    
                    {!! Form::button('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                
            {!! Form::close() !!}
            </div>


            <div style="float: right">
                {!! Form::open(
                    ['route' => ['rekap-jejak.store'], 
                        'role'  => 'form',
                        'method'=> 'post',
                        'class' => 'form-inline']) !!}
                         
                    {{ Form::hidden('route', 'jejak') }}
                    {{ Form::date('tanggal_awal', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }} s/d
                    {{ Form::date('tanggal_akhir', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                    
                    <div class="col-lg-3" style="margin-left: -85px;">
                            {{ Form::select('status_tagihan', ['1' => 'Belum terbayar', '2' => 'Terbayar'], null, ['class' => 'form-control selectpicker', 'placeholder' => 'Status tagihan...', 'data-live-search' => 'false']) }}
                        </div>
                        <div class="col-lg-3" style="margin-left: -15px;">
                    {{ Form::select('status_pekerjaan', ['1' => 'WIP', '2' => 'Selesai'], null, ['class' => 'form-control selectpicker', 'placeholder' => 'Status pekerjaan...', 'data-live-search' => 'false']) }}
                        </div>
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
                        <th>Tanggal Masuk</th>
                        <th>No. Servis Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th>Total Estimasi</th>
                        <th>Pekerjaan / Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sot as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($sot->CurrentPage() - 1) * $sot->PerPage() ) }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
                            <td>{{ $data->sotransaksi->no_transaksi }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td>
                            <td align="right">{{ number_format($data->tagihan) }} Rp</td>
                            <td>
                            {{ $data->status_pekerjaan == 1 ? "WIP" : "Selesai" }} / 
                            {{ $data->status_tagihan == 1 ? "Belum terbayar" : "Terbayar" }}
                            </td>
                            <td>
                                <a href="{{ URL($route . '/' . $data->id) }}" class="btn btn-success">Detail</a>
                                {!! link_to_route($route.'.edit', 'Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $sot->links() }}
@stop
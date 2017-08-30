@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>
            
            <div class="row">
                <div class="col-lg-6">
                    {!! Form::open(['url' => $route.'/cari', 'method' => 'GET', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci']) !!}
                        
                        {!! Form::button('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                </div>

                <div class="col-lg-6">
                    <form class="form-inline" action="" method="POST">
                        <input type="date" class="form-control" value="" name="awal" id="awal" placeholder="Pilih Bulan Awal" required> s/d
                        <input type="date" class="form-control" value="" name="akhir" id="akhir" placeholder="Pilih Bulan AKhir" required>
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>

            @include('template.notification')
            <p></p>
            
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>No. Servis Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ekstimasi as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($ekstimasi->CurrentPage() - 1) * $ekstimasi->PerPage() ) }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ $data->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->sokendaraan->merek->nama_merek }} / {{ $data->sokendaraan->merek->unit_merek }}</td>
                            <td>{{ $data->sokendaraan->no_polisi }}</td>
                            <td>{{ $data->sopelanggan->asuransi->nama_asuransi }}</td>
                            <td>
                                <a href="{{ route($route.'.edit', $data->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Ubah</a>
                                <a href="{{ route($route.'.edit', $data->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $ekstimasi->links() }}

@stop
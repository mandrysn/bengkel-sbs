@extends('template.template')

@section('content')
            <h1 class="page-header">Keuangan</h1>
            
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('pengeluaran') }}" class="btn btn-primary">Pengeluaran</a></li>
                    <li class="active"><a href="#" data-toggle="tab">Pemasukan</a></li>
					<li><a href="{{ url('saldo') }}" class="btn btn-primary">Saldo</a></li>
                </ul>
            
                    <div class="tab-pane"></div>
                    

                    <div class="tab-content">
                    
                    <div class="tab-pane active" id="pemasukan">

                    <h3 class="page-header">{{ $title }}</h3>
            
                    <div style="float: left">
                        @include('template.form_pencarian')
                    </div>

        
                    <div style="float: right">
                        {!! Form::open(
                            ['route' => ['rekap-pemasukan.store'], 
                                'role'  => 'form',
                                'method'=> 'post',
                                'class' => 'form-inline']) !!}
                                 
                            {{ Form::hidden('route', 'pemasukan') }}
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
                        <th>No. Pemasukan</th>
                        <th>Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Jumlah Pemasukan (Rp)</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php ($index = 1)
                @foreach ($pemasukan as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ substr($data->tagihan_id, -1) == '-' ? substr($data->tagihan_id, 0, -1) : $data->tagihan->kode_tagihan . ' [' . $data->tagihan->sotransaksi->sokendaraan->no_polisi . '] ' . $data->tagihan->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
                            <td>{{ number_format($data->jumlah_bayar) }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                            {!! Form::open(['route' => ['pemasukan.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

                    </div>

                </div>
@stop
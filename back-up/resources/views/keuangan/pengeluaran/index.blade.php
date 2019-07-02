@extends('template.template')

@section('content')
            <h1 class="page-header">Keuangan</h1>
            
                <ul class="nav nav-tabs">
                    <li class="active"><a href="pengeluaran" id="pengeluaran" data-toggle="tab">Pengeluaran</a></li>
                    <li><a href="{{ url('pemasukan') }}" class="btn btn-primary">Pemasukan</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="pengeluaran">

                    <h3 class="page-header">Pengeluaran</h3>
            
            {!! Form::open(['url' => 'pengeluaran/cari', 'method' => 'GET', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci']) !!}
                    
                    {!! Form::button('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                
                <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
                
            {!! Form::close() !!}
            
            <p></p>

            @include('template.notification')


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>No. Pengeluaran</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pengeluaran as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($pengeluaran->CurrentPage() - 1) * $pengeluaran->PerPage() ) }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
                            <td>{{ number_format($data->total_pengeluaran) }}</td>
                            <td>
                            {!! Form::open(['route' => ['pengeluaran.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                {!! link_to_route('pengeluaran.edit', ' Ubah', $data->id, ['class' => 'btn btn-primary'] ) !!}
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

                    </div>

                    <div class="tab-pane"></div>
                    
                </div>

@stop
@extends('template.template')

@section('content')
            <h1 class="page-header">Keuangan</h1>
            
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('pengeluaran') }}" class="btn btn-primary">Pengeluaran</a></li>
                    <li class="active"><a href="#" data-toggle="tab">Pemasukan</a></li>
                </ul>
            
                    <div class="tab-pane"></div>
                    

                    <div class="tab-content">
                    
                    <div class="tab-pane active" id="pemasukan">

                    <h3 class="page-header">{{ $title }}</h3>
            
            {!! Form::open(['url' => 'pemasukan/cari', 'method' => 'GET', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci']) !!}
                    
                    {!! Form::button('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                
                <a href="{{ route('pemasukan.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
                
            {!! Form::close() !!}
            
            <p></p>

            @include('template.notification')


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>No. Pemasukan</th>
                        <th>No. Tagihan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Jumlah Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pemasukan as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($pemasukan->CurrentPage() - 1) * $pemasukan->PerPage() ) }}</td>
                            <td>{{ $data->no_transaksi }}</td>
                            <td>{{ $data->tagihan->kode_tagihan }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
                            <td>{{ number_format($data->jumlah_bayar) }}</td>
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
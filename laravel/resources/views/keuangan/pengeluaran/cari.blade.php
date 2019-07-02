@extends('template.template')

@section('content')
            <h1 class="page-header">Keuangan</h1>
            
                <ul class="nav nav-tabs">
                    <li class="active"><a href="pengeluaran" id="pengeluaran" data-toggle="tab">Pengeluaran</a></li>
                    <li><a href="{{ url('pemasukan') }}" class="btn btn-primary">Pemasukan</a></li>
					<li><a href="{{ url('saldo') }}" class="btn btn-primary">Saldo</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="pengeluaran">

                    <h3 class="page-header">{{ $title }}</h3>
            
                    <div style="float: left">
                        @include('template.form_pencarian')
                    </div>

        
                    <div style="float: right">
                        {!! Form::open(
                            ['route' => ['rekap-pengeluaran.store'], 
                                'role'  => 'form',
                                'method'=> 'post',
                                'class' => 'form-inline']) !!}
                                 
                            {{ Form::hidden('route', 'pengeluaran') }}
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
                        <th>Tanggal Transaksi</th>
						<th>Jenis Pengeluaran</th>
						<th>Keterangan Transaksi</th>
                        <th>Total Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php ($index = 1)
                @foreach ($pengeluaran as $index => $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->tanggal_masuk }}</td>
							<td>{{ $data->operasional->nama_operasional }}</td>
							<td>{{ $data->keterangan_transaksi }}</td>
                            <td>{{ number_format($data->total_pengeluaran) }}</td>
                            <td>
                            {!! Form::open(['route' => ['pengeluaran.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
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
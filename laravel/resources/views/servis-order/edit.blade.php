@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

            <div class="form-horizontal">
                <div class="form-group">
                    {{ Form::label('Kategori', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-4">
                        <button id="keluhan" class="btn btn-primary">Keluhan Servis Order</button>
                        <button id="pergantian" class="btn btn-primary">Pergantian Part</button>
                        <a href="{{ route($route.'.index') }}" class="btn btn-success">Selesai</a>
                    </div>
                </div>
            </div>

            <span id="keluhan_show">
                    {!! Form::model($transaksi, ['method' => 'PATCH', 'action' => ['SoTransaksiController@update', $transaksi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                    
                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $transaksi->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Transaksi', 'readonly']) }}
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('so_kendaraan_id') ? ' has-error' : '' }}">
                            {{ Form::label('pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('so_kendaraan_id', $transaksi->sokendaraan->sopelanggan->nama_pelanggan.' - '. $transaksi->sokendaraan->no_polisi, ['class' => 'form-control', 'placeholder' => 'Nama Pelanggan', 'readonly']) }}
                                @if($errors->has('so_kendaraan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('so_kendaraan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group">
                            {{ Form::label('asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('asuransi_id', $transaksi->asuransi_id == '0' ? $transaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $transaksi->asuransi->nama_asuransi, ['class' => 'form-control', 'placeholder' => 'Nama Asuransi', 'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('keluhan') ? ' has-error' : '' }}">
                            {{ Form::label('keluhan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('keluhan', null, ['class' => 'form-control', 'placeholder' => 'Keluhan']) }}
                                @if($errors->has('keluhan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keluhan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('perbaikan') ? ' has-error' : '' }}">
                            {{ Form::label('perbaikan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('perbaikan', null, ['class' => 'form-control', 'placeholder' => 'Perbaikan']) }}
                                @if($errors->has('perbaikan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perbaikan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('keterangan', null, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}
                                @if($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>


                    
                    {!! Form::close() !!}
                    </span>

                    <span id="pergantian_show">
                    {!! Form::open(
                        ['route' => ['ganti-part.store'], 
                         'role'  => 'form',
                         'method'=> 'post',
                         'class' => 'form-horizontal',
                         'files' => 'true']) !!}
                    
    <div class="form-group{{ $errors->has('keterangan_ganti') ? ' has-error' : '' }}">
        {{ Form::label('pergantian_part', null, ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            {{ Form::text('keterangan_ganti', null, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}
            @if($errors->has('keterangan_ganti'))
                <span class="help-block">
                    <strong>{{ $errors->first('keterangan_ganti') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('montir') ? ' has-error' : '' }}">
        {{ Form::label('montir', null, ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            {{ Form::text('montir', null, ['class' => 'form-control', 'placeholder' => 'Nama Montir']) }}
            @if($errors->has('montir'))
                <span class="help-block">
                    <strong>{{ $errors->first('montir') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('layanan') ? ' has-error' : '' }}">
        {{ Form::label('layanan', null, ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            <select name="layanan" class="form-control selectpicker" data-live-search="true" placeholder="Pilih layanan perbaikan...">
                <option disabled selected>Pilih layanan...</option>
                <option value="1">Bongkar Pasang</option>
                <option value="2">Las Ketok</option>
                <option value="3">Dempul</option>
                <option value="4">Poles</option>
            </select>
            @if($errors->has('layanan'))
                <span class="help-block">
                    <strong>{{ $errors->first('layanan') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    {{ Form::hidden('so_transaksi_id', $transaksi->id)}}
    
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    
    {!! Form::close() !!}
</span>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Keluhan</th>
                            <th>Perbaikan</th>
                            <th>Keterangan</th>
                            <th colspan="2" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->keluhan }}</td>
                            <td>{{ $data->perbaikan }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                                @if ($data->status == 1)
                            {!! Form::open(['route' => ['so-detail.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            @endif
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
                



        <div class="row">
        <div class="col-md-9">
        <table class="table table-bordered table-hover">
                @foreach($pergantians as $index => $pergantian)
            <tr>
            <th width="8">{{ $index + 1 }}.</th>
            <td width="60%">{{ $pergantian->keterangan_ganti }}</td>
            <td width="20%">{{ is_null($pergantian->montir) ? 'Tidak ada.' : $pergantian->montir}}</td>
            <td width="20%">{{ is_null($pergantian->layanan) ? 'Tidak ada.' : $pergantian->jenis_layanan}}</td>
			<td width="7">
                    {!! Form::open(['route' => ['ganti-part.destroy', $pergantian->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                    
                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                    {!! Form::close() !!}
                    </td>
            </tr>
            @endforeach
        </table>
        </div>
        </div>

        <script>
            $(document).ready(function(){
                $("#keluhan_show").hide();
                $("#pergantian_show").hide();
                
                $("#keluhan").click(function(){
                    $("#keluhan_show").show();
                    $("#pergantian_show").hide();
                });
                $("#pergantian").click(function(){
                    $("#pergantian_show").show();
                    $("#keluhan_show").hide();
                });
            });
            </script>
@stop
@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif
                
                    {!! Form::model($transaksi, ['method' => 'PATCH', 'action' => ['PreSoController@update', $transaksi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                    
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
                                <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                                {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route($route.'.index') }}" class="btn btn-success">Selesai</a>
                            </div>
                        </div>


                    
                    {!! Form::close() !!}
                
                
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
                            {!! Form::open(['route' => ['so-detail.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
                
@stop
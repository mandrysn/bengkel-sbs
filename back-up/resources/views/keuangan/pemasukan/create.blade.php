@extends('template.template')

@section('content')

<h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

            {!! Form::open(
               ['route' => ['pemasukan.store'], 
                'role'  => 'form',
                'method'=> 'post',
                'class' => 'form-horizontal',
                'files' => 'true']) !!}

                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_pemasukan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $noma, ['class' => 'form-control', 'placeholder' => 'No. Pengeluaran', 'readonly']) }}
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...']) }}
                                @if($errors->has('tanggal_masuk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tagiahn_id') ? ' has-error' : '' }}">
                            {{ Form::label('cari_invoice', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="tagihan_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                    <option disabled selected>Pilih Invoice...</option>
                                    @foreach ( $tagihan as $key )
                                        <option value="{{ $key->id }}">{{ $key->kode_tagihan }} - {{ $key->sotransaksi->no_transaksi }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('tagihan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tagihan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('keterangan', null, ['class' => 'form-control', 'placeholder' => 'Keterangan Transaksi']) }}
                            </div>
                        </div>

                    </div>
                    
                
               </div>

               @include('template.button-form')
                
            {!! Form::close() !!}

@endsection
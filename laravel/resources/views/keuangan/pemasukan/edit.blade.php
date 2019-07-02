@extends('template.template')

@section('content')

<h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

            {!! Form::model($pem, ['method' => 'PATCH', 'action' => ['PemasukanController@update', $pem->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-horizontal">
                        <div class="form-group">
                            {{ Form::label('no_pemasukan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $pem->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Pengeluaran', 'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('tanggal_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('tanggal_masuk', $pem->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('cari_invoice', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_tagihan', $pem->tagihan->kode_tagihan, ['class' => 'form-control', 'placeholder' => 'kode tagihan...', 'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah_bayar') ? ' has-error' : '' }}">
                            {{ Form::label('total_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('jumlah_bayar', $pem->jumlah_bayar, ['class' => 'form-control', 'placeholder' => 'Total Transaksi']) }}
                                @if($errors->has('jumlah_bayar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_bayar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('keterangan', $pem->keterangan, ['class' => 'form-control', 'placeholder' => 'Keterangan Transaksi']) }}
                            </div>
                        </div>

                    </div>
                    
                
               </div>

               <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="{{ URL('pemasukan') }}" class="btn btn-default">Kembali</a>
                        {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                
            {!! Form::close() !!}

@endsection
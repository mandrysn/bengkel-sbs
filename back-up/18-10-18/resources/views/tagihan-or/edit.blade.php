@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

            {!! Form::model($data,
               ['method' => 'PATCH',
                'action' => [$controller.'@update', $data->id],
                'files' => 'true',
                'class' => 'form-horizontal']) !!}

            <div class="form-group">
                    {{ Form::label('No. Tagihan', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                    {{ Form::text('kode_tagihan', null, ['class' => 'form-control', 'placeholder' => 'Nomor Tagihan', 'readonly']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('No. Servis Order', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                    {{ Form::text('no_transaksi', $data->sotransaksi->no_transaksi, ['class' => 'form-control', 'placeholder' => 'Nomor Transaksi SO', 'readonly']) }}
                    </div>
                </div>    

                <div class="form-group">
                    {{ Form::label('tanggal_nasuk', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'readonly']) }}
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('jumlah_or') ? ' has-error' : '' }}">
                    {{ Form::label('jumlah_OR', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::number('jumlah_or',  null, ['class' => 'form-control', 'placeholder' => 'Jumlah OR', 'min' => '0']) }}
                    </div>
                    @if($errors->has('jumlah_or'))
                        <span class="help-block">
                            <strong>{{ $errors->first('jumlah_or') }}</strong>
                        </span>
                    @endif
                </div>
                
                @include('template.button-form')
                
                {!! Form::close() !!}
@endsection
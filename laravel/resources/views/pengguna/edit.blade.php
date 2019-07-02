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
                'action' => ['PenggunaController@update', $data->id],
                'files' => 'true',
                'class' => 'form-horizontal']) !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {{ Form::label('nama_lengkap', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) }}
                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{ Form::label('username', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Username / Email']) }}
                        @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>	

<div class="form-group{{ $errors->has('password_baru') ? 'has-error' : '' }}">
    {{ Form::label('password_baru', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        <input name="password_baru" type="password" value="" id="password" class="form-control">
        @if ($errors->has('password_baru'))
        <span class="help-block">
        <strong>{{ $errors->first('password_baru')}}</strong>
        </span>
        @endif
    </div>        
</div>

				<div class="form-group{{ $errors->has('ulang_password') ? 'has-error' : '' }}">
					{{ Form::label('ulang_password_baru', null, ['class' => 'col-lg-2 control-label']) }}
					<div class="col-lg-3">
                    <input name="ulang_password" type="password" value="" id="password" class="form-control">
						@if ($errors->has('ulang_password'))
						<span class="help-block">
							<strong>{{ $errors->first('ulang_password')}}</strong>
						</span>
						@endif
					</div>        
				</div>


                <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                    {{ Form::label('group_pengguna', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::select('group_id', $group, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih Group Pengguna...', 'data-live-search' => 'false']) }}
                        @if($errors->has('group_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('group_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

<div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::button('Batal', ['class' => 'btn btn-default', 'onclick' => "self.history.back()"]) !!}
                                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                
            {!! Form::close() !!}


@endsection
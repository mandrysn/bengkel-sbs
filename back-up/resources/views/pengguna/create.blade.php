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
               ['route' => ['pengguna.store'], 
                'role'  => 'form',
                'method'=> 'post',
                'class' => 'form-horizontal',
                'files' => 'true']) !!}

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

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {{ Form::label('Password', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) }}
                        @if($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

				<div class="form-group{{ $errors->has('ulang_password') ? 'has-error' : '' }}">
					{{ Form::label('ulang_password', null, ['class' => 'col-lg-2 control-label']) }}
					<div class="col-lg-3">
						{{ Form::text('ulang_password', null, ['class' => 'form-control', 'placeholder' => 'Ulangi Password']) }}
						@if ($errors->has('ulang_password'))
						<span class="help-block">
							<strong>{{ $errors->first('ulang_password')}}</strong>
						</span>
						@endif
					</div>        
				</div>


                    <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                        {{ Form::label('group', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::select('group_id', $group, null, ['id' => 'id', 'class' => 'form-control selectpicker', 'placeholder' => 'Pilih Group...', 'data-live-search' => 'true']) }}
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
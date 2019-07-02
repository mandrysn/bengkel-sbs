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
                @include($route.'.form')
                
            {!! Form::close() !!}
@endsection
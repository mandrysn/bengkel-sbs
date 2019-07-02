@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>
            
            @include('template.notification')

            {!! Form::open(
               ['route' => [$route.'.store'], 
                'role'  => 'form',
                'method'=> 'post',
                'class' => 'form-horizontal',
                'files' => 'true']) !!}
                @include($route.'.form')
                
            {!! Form::close() !!}

@endsection
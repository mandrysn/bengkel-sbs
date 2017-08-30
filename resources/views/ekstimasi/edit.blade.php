@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>
           
            @include('template.notification')
            
            @include($route.'.form')
                
@stop
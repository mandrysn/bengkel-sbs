@extends('template.template')


@section('content')

            <h1 class="page-header">{{ $title }}</h1>
            
            <p></p>
            @include('template.notification')

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfmerek') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Laporan Merek</h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfbarang') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Laporan Barang</h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfasuransi') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Laporan Asuransi</h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfsuplier') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Laporan Supplier </h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfso') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Laporan Servis Order </h4></center>
  		</a>
  		</div>
	</div>
</div>

@endsection
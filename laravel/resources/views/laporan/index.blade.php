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
    		<center><h4>Rekap Merek</h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfbarang') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Rekap Barang</h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfasuransi') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Rekap Asuransi</h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfsuplier') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Rekap Supplier </h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfpelanggan') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Rekap Pelanggan </h4></center>
  		</a>
  		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default">
  		<div class="panel-body">
  		<a class="link" href="{{ URL($route . '/pdfkendaraan') }}">
    		<center><h2 class="glyphicon glyphicon-book"></h2></center>
    		<center><h4>Rekap Kendaraan </h4></center>
  		</a>
  		</div>
	</div>
</div>

@endsection
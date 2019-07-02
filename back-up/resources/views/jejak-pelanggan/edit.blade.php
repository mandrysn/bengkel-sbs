@extends('template.template')

@section('content')
<style type="text/css">
	#gambar{
		max-width: 100%;
	}
	@media screen and (max-width: 1199px) {
	  #gambar {
	   	float: none;
		margin-top: 5px;
		margin-bottom: 5px;
	  }
	}

</style>
            <h1 class="page-header">{{ $title }}</h1>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->no_claim }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Kendaraan</h2>

                <table class="table">
                    <tr><th width="20%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $sot->sotransaksi->sokendaraan->no_polisi }} / {{ $sot->sotransaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->no_mesin }} / {{ $sot->sotransaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $sot->sotransaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->warna_kendaraan }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">

                <div class="form-horizontal">
                {!! Form::model($sot, ['method' => 'PATCH', 'action' => ['JejakPelangganController@update', $sot->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                {{ Form::hidden('km_kendaraan', $sot->sotransaksi->sokendaraan->km_kendaraan) }}
                <h4>Foto Sesudah</h4>
                <div class="form-group{{ $errors->has('foto_depan') ? ' has-error' : '' }}">
                {{ Form::label('foto_kendaraan', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::file('foto_depan', null, ['class' => 'form-control']) }}
                    @if($errors->has('foto_depan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_depan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            

            <div class="form-group{{ $errors->has('foto_proses') ? ' has-error' : '' }}">
                {{ Form::label('foto_proses', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    <input name="foto_proses[]" class="filestyle" type="file" id="foto_proses" multiple>
                    @if($errors->has('foto_proses'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_proses') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('status_tagihan') ? ' has-error' : '' }}">
                {{ Form::label('status_tagihan', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::select('status_tagihan', ['1' => 'Belum terbayar', '2' => 'Terbayar'], null, ['class' => 'form-control selectpicker', 'placeholder' => 'Status tagihan...', 'data-live-search' => 'false']) }}
                    @if($errors->has('status_tagihan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status_tagihan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('status_pekerjaan') ? ' has-error' : '' }}">
                {{ Form::label('status_pekerjaan', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::select('status_pekerjaan', ['1' => 'WIP', '2' => 'Selesai'], null, ['class' => 'form-control selectpicker', 'placeholder' => 'Status pekerjaan...', 'data-live-search' => 'false']) }}
                    @if($errors->has('status_pekerjaan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status_pekerjaan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            @include('template.button-form')
            </div>


        {!! Form::close() !!}	
            </div>

            <div class="col-md-6">
                <table class="table table-bordered table-hover">
                    <tfoot>
                        <tr>
                            <th>{!! Html::image(asset('asset/order/depan/'.$sot->sotransaksi->sokendaraan->foto_depan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            
@stop
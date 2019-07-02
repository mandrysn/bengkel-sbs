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
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $sot->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $sot->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $sot->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $sot->sopelanggan->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $sot->sopelanggan->no_claim }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Kendaraan</h2>

                <table class="table">
                    <tr><th width="20%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $sot->sokendaraan->no_polisi }} / {{ $sot->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sokendaraan->no_mesin }} / {{ $sot->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $sot->sokendaraan->merek->nama_merek }} / {{ $sot->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->warna_kendaraan }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr><th width="20%">Tanggal Masuk</th><td width="1%">:</td><td>{{ $sot->sokendaraan->tanggal_masuk }}</td></tr>
                    <tr><th>Ekstimasi Tanggal Keluar</th><td>:</td><td>{{ $sot->sokendaraan->tanggal_selesai }}</td></tr>
                </table>

                <div class="form-group{{ $errors->has('foto_depan') ? ' has-error' : '' }}">
                {{ Form::label('foto_depan', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::file('foto_depan', null, ['class' => 'form-control']) }}
                    @if($errors->has('foto_depan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_depan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('foto_belakang') ? ' has-error' : '' }}">
                {{ Form::label('foto_belakang', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::file('foto_belakang', null, ['class' => 'form-control']) }}
                    @if($errors->has('foto_belakang'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_belakang') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('foto_kanan') ? ' has-error' : '' }}">
                {{ Form::label('foto_kanan', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::file('foto_kanan', null, ['class' => 'form-control']) }}
                    @if($errors->has('foto_kanan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_kanan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('foto_kiri') ? ' has-error' : '' }}">
                {{ Form::label('foto_kiri', null, ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-3">
                    {{ Form::file('foto_kiri', null, ['class' => 'form-control']) }}
                    @if($errors->has('foto_kiri'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_kiri') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
	
            </div>

            <div class="col-md-6">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{!! Html::image(asset('asset/order/kiri/'.$sot->sokendaraan->foto_kiri), null, ['class'=> 'img-rounded img-responsive' , 'id' => 'gambar']) !!}</th>
                            <th>{!! Html::image(asset('asset/order/kanan/'.$sot->sokendaraan->foto_kanan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>{!! Html::image(asset('asset/order/depan/'.$sot->sokendaraan->foto_depan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                            <th>{!! Html::image(asset('asset/order/belakang/'.$sot->sokendaraan->foto_belakang), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            
@stop
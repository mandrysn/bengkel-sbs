@extends('template.template')

@section('content')

<h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

            <div class="form-horizontal">
                    <div class="form-group">
                        {{ Form::label('Kategori Transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-4">
                            <button id="in" class="btn btn-primary">INVOICE</button>
                            <button id="or" class="btn btn-primary">TAGIHAN OR</button>
                            <button id="tf" class="btn btn-primary">UANG MASUK</button>
                        </div>
                    </div>
                </div>

            {!! Form::open(
               ['route' => ['pemasukan.store'], 
                'role'  => 'form',
                'method'=> 'post',
                'class' => 'form-horizontal',
                'files' => 'true']) !!}


                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_pemasukan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $noma, ['class' => 'form-control', 'placeholder' => 'No. Pengeluaran', 'readonly']) }}
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...']) }}
                                @if($errors->has('tanggal_masuk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-horizontal{{ $errors->has('tagihan_id') ? ' has-error' : '' }}" id="rek_p">
                            <div class="form-group">
                                {{ Form::label('transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-3">
                                    {{ Form::text('tagihan_id', null, ['class' => 'form-control', 'placeholder' => 'Transaksi']) }}
                                </div>
                                @if($errors->has('tagihan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tagihan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-horizontal" id="tf_p">
                            <div class="form-group">
                                {{ Form::label('total_transfer', null, ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-3">
                                    {{ Form::number('jumlah_bayar', null, ['class' => 'form-control', 'placeholder' => 'Total Transfer', 'min' => '0']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tagihan_id') ? ' has-error' : '' }}" id="in_p">
                            {{ Form::label('cari_invoice', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="tagihan_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                    <option disabled selected>Pilih Invoice...</option>
                                    @foreach ( $tagihan as $key )
                                        <option value="{{ $key->id }}-1">{{ $key->kode_tagihan }} - {{ $key->sotransaksi->no_transaksi }} [{{ $key->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }} - {{ $key->sotransaksi->sokendaraan->no_polisi }}] Rp {{ number_format($key->tagihan) }} / {{ $key->sotransaksi->asuransi_id == '0' ? $key->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $key->sotransaksi->asuransi->nama_asuransi }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tagihan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tagihan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tagihan_id') ? ' has-error' : '' }}" id="or_p">
                                {{ Form::label('cari_OR', null, ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-3">
                                    <select name="tagihan_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                        <option disabled selected>Pilih OR...</option>
                                        @foreach ( $or as $key )
                                    <option value="{{ $key->id }}-2">{{ $key->kode_tagihan }} - {{ $key->sotransaksi->no_transaksi }} [{{ $key->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }} - {{ $key->sotransaksi->sokendaraan->no_polisi }}] Rp {{ number_format($key->jumlah_or) }} / {{ $key->sotransaksi->asuransi_id == '0' ? $key->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $key->sotransaksi->asuransi->nama_asuransi }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('tagihan_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tagihan_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group">
                            {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('keterangan', null, ['class' => 'form-control', 'placeholder' => 'Keterangan Transaksi']) }}
                            </div>
                        </div>

                    </div>
                    
                
               </div>

               @include('template.button-form')
                
            {!! Form::close() !!}
            <script>
                    $(document).ready(function(){
                        $("#in_p").hide();
                        $("#or_p").hide();
                        $("#tf_p").hide();
                        $("#rek_p").hide();
                        
                        $("#in").click(function(){
                            $("#or_p").hide();
                            $("#rek_p").hide();
                            $("#tf_p").hide();
                            $("#in_p").show();
                        });
                        $("#or").click(function(){
                            $("#or_p").show();
                            $("#in_p").hide();
                            $("#rek_p").hide();
                            $("#tf_p").hide();
                        });
                        $("#tf").click(function(){
                            $("#rek_p").show();
                            $("#tf_p").show();
                            $("#in_p").hide();
                            $("#or_p").hide();
                        });
                    });
                    </script>
@endsection
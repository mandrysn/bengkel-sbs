@extends('template.template')

@section('content')

<h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

			{{--<div class="form-horizontal">
                        <div class="form-group">
                            {{ Form::label('Kategori Transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <button id="operasional" class="btn btn-primary">Operasional</button>
                                <button id="suplier" class="btn btn-primary">Supplier</button>
                            </div>
                        </div>
			</div>--}}


            {!! Form::open(
               ['route' => ['pengeluaran.store'], 
                'role'  => 'form',
                'method'=> 'post',
                'class' => 'form-horizontal',
                'files' => 'true']) !!}

                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_pengeluaran', null, ['class' => 'col-lg-2 control-label']) }}
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

                        <div class="form-group{{ $errors->has('operasional_id') ? ' has-error' : '' }}" id="operasional_q">
                            {{ Form::label('cari_operasional', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::select('operasional_id', $operasional, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih Operasional...', 'data-live-search' => 'true']) }}
                                @if($errors->has('operasional_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('operasional_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('utang_id') ? ' has-error' : '' }}" id="suplier_p">
                            {{ Form::label('cari_supplier', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="utang_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Suplier...">
                                    <option disabled selected>Pilih Supplier Terutang...</option>
                                    @foreach ( $utang as $key )
                                        <option value="{{ $key->id }}">{{ $key->suplier->nama_suplier }} - Rp {{ number_format($key->sisa) }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('utang_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('utang_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah_bayar') ? ' has-error' : '' }}">
                            {{ Form::label('total_pengeluaran', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('jumlah_bayar', null, ['class' => 'form-control', 'placeholder' => 'Total Operasional']) }}
                                @if($errors->has('jumlah_bayar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_bayar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						
						<div class="form-group">
                            {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('keterangan_transaksi', null, ['class' => 'form-control', 'placeholder' => 'Keterangan Transaksi']) }}
                            </div>
                        </div>

                    </div>
                    
                
               </div>

               @include('template.button-form')
                
            {!! Form::close() !!}
            <script>
                $(document).ready(function(){
                    $("#suplier_p").hide();
                    /*$("#operasional_p").hide();*/
                    
                    $("#suplier_q").hide();
                    /*$("#operasional_q").hide();*/
                    
                    $("#suplier").click(function(){
                        $("#operasional_q").hide();
                        $("#suplier_p").show();
                    });
                    $("#operasional").click(function(){
                        $("#operasional_q").show();
                        $("#suplier_p").hide();
                    });
                });
                </script>
@endsection
@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($order, ['method' => 'PATCH', 'action' => [$controller.'@update', $order->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-group{{ $errors->has('bk_transaksi') ? ' has-error' : '' }}">
                        {{ Form::label('no_bukti_barang_keluar', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('bk_transaksi', $order->bk_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Bukti Barang Keluar', 'readonly']) }}
                            @if($errors->has('bk_transaksi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bk_transaksi') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                        {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::date('tanggal_masuk', $order->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'readonly']) }}
                            @if($errors->has('tanggal_masuk'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                        {{ Form::label('no_so_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                        {{ Form::text('no_transaksi', $order->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No Servis Order...', 'readonly']) }}
                            @if($errors->has('no_transaksi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_transaksi') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('no_polisi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                        {{ Form::text('no_polisi', $order->sokendaraan->no_polisi, ['class' => 'form-control', 'placeholder' => 'No Polisi...', 'readonly']) }}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}" id="sp_p">
                        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::select('id', $barang, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih Barang...', 'data-live-search' => 'true']) }}
                            @if($errors->has('id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantity_bk') ? ' has-error' : '' }}">
                        {{ Form::label('Jumlah', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::number('quantity_bk',  null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Jumlah']) }}
                            @if($errors->has('quantity_bk'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity_bk') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @include('template.button-form')

                {!! Form::close() !!}
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang / Kode</th>
                            <th>Qty</th>
                            <th>Supplier</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                
@stop
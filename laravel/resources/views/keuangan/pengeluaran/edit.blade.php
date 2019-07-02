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
                            <div class="col-lg-3">
                                <button id="operasional" class="btn btn-primary">Operasional</button>
                                <button id="suplier" class="btn btn-primary">Supplier</button>
                            </div>
                        </div>
                    </div>


                    {!! Form::model($pen, ['method' => 'PATCH', 'action' => ['PengeluaranController@update', $pen->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_pengeluaran', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $pen->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Pengeluaran', 'readonly']) }}
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
                                {{ Form::text('tanggal_masuk', $pen->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'readonly']) }}
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
                                {{ Form::select('operasional_id', $operasional, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih Operasional...', 'data-live-search' => 'false']) }}
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
                                    <option disabled selected>Pilih Barang...</option>
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

                    </div>
                    
                    <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="{{ URL('pengeluaran') }}" class="btn btn-default">Kembali</a>
                        {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                
            {!! Form::close() !!}

            <p>&nbsp;</p>
            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="3%">#</th>
                            <th width="30%">Status Transaksi</th>
                            <th>Jumlah Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    @if($csp > 0)
                    <tr>
                        <td colspan="6">Detail Pembayaran Operasional</td>
                    </tr>
                    @endif
                    @foreach($op as $index => $data)
                    
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>Pembayaran {{ $data->operasional->nama_operasional }}</td>
                        <td width="15%">{{ number_format($data->jumlah_bayar) }}</td>
                    </tr>
                    @endforeach
                        
                        @if($csp > 0)
                        <tr>
                            <td colspan="6">Detail Pembayaran Supplier</td>
                        </tr>
                        @endif
                        @foreach($sp as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>Pembayaran Ke {{ $data->utang->suplier->nama_suplier }}</td>
                            <td width="15%">{{ number_format($data->jumlah_bayar) }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <p></p>


            <script>
                $(document).ready(function(){
                    $("#suplier_p").hide();
                    $("#operasional_p").hide();
                    
                    $("#suplier_q").hide();
                    $("#operasional_q").hide();
                    
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
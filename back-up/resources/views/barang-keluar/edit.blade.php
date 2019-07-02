@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($order, ['method' => 'PATCH', 'action' => [$controller.'@update', $order->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {{ Form::label('no_bukti_barang_keluar', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('bbk_transaksi', $order->bbk_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Bukti Barang Keluar', 'readonly']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('tanggal_masuk', $order->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'readonly']) }}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            <select name="id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                <option disabled selected>Pilih Barang...</option>
                                @foreach ( $barang as $key )
                                    <option value="{{ $key->id }}">{{ $key->suplier->nama_suplier }} - {{ $key->barang->kode_barang }} - {{ $key->barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route($route.'.index') }}" class="btn btn-success">Selesai</a>
                        </div>
                    </div>

                {!! Form::close() !!}
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang / Kode</th>
                            <th>Qty</th>
                            <th>Harga (Rp)</th>
                            <th>Diskon (%)</th>
                            <th>Jumlah (Rp)</th>
                            <th>Supplier</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bbk as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }} / {{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->bk_quantity }} {{ $data->barang->satuan->nama_satuan }}</td>
                            <td>
                            {{ number_format($data->harga_transaksi) }}
                            </td>
                            <td>{{ $data->diskon }}</td>
                            <td>{{ number_format(( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bk_quantity) }}</td>
                            <td>{{ $data->suplier->nama_suplier }}</td>
                            <td>{{ $data->keterangan_transaksi }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
@stop
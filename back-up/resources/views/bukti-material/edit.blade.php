@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($sot, ['method' => 'PATCH', 'action' => ['BuktiMaterialController@update', $sot->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                <div class="form-horizontal">
                    <div class="form-group">
                        {{ Form::label('no_bukti_material_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('bbm_material', $sot->bbm_material, ['class' => 'form-control', 'placeholder' => 'No Bukti Material Masuk', 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('no_transaksi_material', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('ma_transaksi', $sot->material->ma_transaksi, ['class' => 'form-control', 'placeholder' => 'Nomor SO Transaksi', 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('tanggal_invoice', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('tanggal_invoice', $sot->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Tanggal invoice', 'readonly']) }}
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('material_barang_id') ? ' has-error' : '' }}">
                        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            <select name="material_barang_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                <option disabled selected>Pilih Barang...</option>
                                @foreach ( $barang as $key )
                                    <option value="{{ $key->id }}">{{ $key->barang->kode_barang }} - {{ $key->barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('material_barang_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('material_barang_id') }}</strong>
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
                </div>
                
                {!! Form::close() !!}

                <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Supplier</th>
                                <th width="20%">Harga (Rp)</th>
                                <th width="12%">Qty</th>
                                <th>Diskon Suplier (%)</th>
                                <th>Total (Rp)</th>
                                <th>Keterangan</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dbm as $index => $data)
                        <tr>
                            {!! Form::model($sot, ['method' => 'PATCH', 'action' => [$controller.'@update', $data->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>
                                {{ $data->suplier->nama_suplier }}
                                {{ Form::hidden('total', ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bm_quantity) }}
                                {{ Form::hidden('qty', $data->bm_quantity) }}
                                </td>
                                <td>{{ number_format($data->harga_transaksi) }}</td>
                                <td>
                                <div class="input-group{{ $errors->has('bm_quantity') ? ' has-error' : '' }}">
                                {{ Form::number('bm_quantity', $data->bm_quantity, ['class' => 'form-control', 'placeholder' => 'Qty', 'max' => '100', 'min' => '1']) }}<span class="input-group-addon">/{{  $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</span>
                                </div>
                                @if($errors->has('bm_quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bm_quantity') }}</strong>
                                    </span>
                                @endif
                                </td>
                                <td>{{ $data->diskon }}</td>
                                <td>{{ number_format(( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bm_quantity) }}</td>
                                <td>{{ $data->keterangan_transaksi }}</td>
                                <td width="5%">{!! Form::submit('Perbarui', ['class' => 'btn btn-success']) !!}</td>
                                
                            {!!  Form::close() !!}
                            <td width="5%">
                                    {!! Form::open(['route' => ['detail-bukti-material.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                
                                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}
    
                                {!! Form::close() !!}
                            </td>
    
                        </tr>
                            
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
@stop
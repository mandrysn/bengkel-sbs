@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($transaksi, ['method' => 'PATCH', 'action' => [$controller.'@update', $transaksi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {{ Form::label('no_transaksi_material', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('po_transaksi', $transaksi->ma_transaksi, ['class' => 'form-control', 'placeholder' => 'No. PO Material', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('supplier', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('suplier_id', $transaksi->suplier->nama_suplier, ['class' => 'form-control', 'placeholder' => 'Supplier', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('tanggal_pesan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('tanggal_masuk', $transaksi->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('barang_id') ? ' has-error' : '' }}" id="sp_p">
                        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::select('barang_id', $barang, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih Barang...', 'data-live-search' => 'true']) }}
                            @if($errors->has('barang_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('barang_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                        {{ Form::label('Jumlah', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::number('quantity',  null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Jumlah']) }}
                            @if($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('diskon') ? ' has-error' : '' }}">
                            {{ Form::label('Diskon', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                    <div class="input-group">
                                {{ Form::text('diskon',  null, ['class' => 'form-control', 'placeholder' => 'Diskon', 'style' => 'padding-right: 0']) }}
                                <span class="input-group-addon">%</span>
                                @if($errors->has('diskon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diskon') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('keterangan_transaksi', null, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                            @if($ma->count() > 0)
                            <a href="{{ route('order-material.index') }}" class="btn btn-success">Selesai</a>
                            @endif
                        </div>
                    </div>

                {!! Form::close() !!}

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang / Kode</th>
                                <th>Kode Part</th>
                                <th>Qty</th>
                                <th>Harga (Rp)</th>
                                <th>Diskon (%)</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>

                    <tbody>
                    @php ($hasil = 0 )
                    @foreach($ma as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->barang->no_part_barang }}</td>
                            <td width="15%">
                                {{ $data->ma_quantity }}
								{{ $data->barang->satuan->kode_satuan }}
                            </td>
                            <td align="right">{{ number_format($data->harga_transaksi) }}</td>
                            <td>{{ $data->diskon }} %</td>
                            <td align="right">{{ number_format( $hasil = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->ma_quantity ) }}</td>
                            <td width="15%">{{ $data->keterangan_transaksi }}</td>
                            <td>
                            {!! Form::open(['route' => ['transaksi-material.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            {{ Form::hidden('total',  $total += $hasil) }}
                            </td>
                        </tr>
                        
                    @endforeach
                        <tr>
                            <td colspan="6" align="right"><h4>Total</h4></td>
                            <td align="right"><h4>{{ number_format($total) }}</h4></td>
                        </tr>
                    </tbody>
                </table>

                
                
@stop
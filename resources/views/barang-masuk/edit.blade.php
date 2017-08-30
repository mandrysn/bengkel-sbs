@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                <div class="form-horizontal">
                    <div class="form-group">
                        {{ Form::label('no_bukti_barang_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('bm_transaksi', $sot->bm_transaksi, ['class' => 'form-control', 'placeholder' => 'No Bukti Barang Masuk', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('no_po_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('po_transaksi', $sot->po_transaksi, ['class' => 'form-control', 'placeholder' => 'Nomor PO Transaksi', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::date('tanggal_masuk', $sot->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Tanggal Masuk', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ url('barang-masuk') }}" class="btn btn-primary">Selesai</a>
                        </div>
                    </div>
                </div>
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pekerjaan / Item</th>
                            <th>Supplier</th>
                            <th width="20%">Harga</th>
                            <th width="12%">Qty</th>
                            <th>Keterangan</th>
                            <th width="30">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dbm as $index => $data)
                        {!! Form::model($sot, ['method' => 'PATCH', 'action' => [$controller.'@update', $data->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->suplier->nama_suplier }}</td>
                            <td>
                            <div class="form-group{{ $errors->has('harga_bm') ? ' has-error' : '' }}">
                            {{ Form::number('harga_bm', $data->harga_bm, ['class' => 'form-control', 'placeholder' => 'Harga Barang']) }}
                            @if($errors->has('harga_bm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('harga_bm') }}</strong>
                                </span>
                            @endif
							</div>
                            </td>
                            <td>
                            <div class="input-group{{ $errors->has('quantity_bm') ? ' has-error' : '' }}">
                            {{ Form::number('quantity_bm', $data->quantity_bm, ['class' => 'form-control', 'placeholder' => 'Qty', 'max' => $data->quantity, 'min' => '0']) }}<span class="input-group-addon">/{{  $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</span>
                            
							</div>
                            @if($errors->has('quantity_bm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity_bm') }}</strong>
                                </span>
                            @endif
                            </td>
                            <td>{{ $data->keterangan_transaksi }}</td>
                            @if ($data->quantity_bm == $data->quantity)
                            <td>{!! Form::submit('Lengkap', ['class' => 'btn btn-success', 'disabled']) !!}</td>
                            @else
                            <td>{!! Form::submit('Perbarui', ['class' => 'btn btn-success']) !!}</td>
                            @endif
                            
                        </tr>
                        {!!  Form::close() !!}
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
@stop
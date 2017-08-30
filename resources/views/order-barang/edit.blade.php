@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($order, ['method' => 'PATCH', 'action' => ['PemesananBarangController@update', $order->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {{ Form::label('no_po_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('po_transaksi', $order->po_transaksi, ['class' => 'form-control', 'placeholder' => 'No. PO Barang', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('tanggal_pesan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::date('tanggal_masuk', $order->created_at, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('supplier', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('suplier_id', $order->suplier->nama_suplier, ['class' => 'form-control', 'placeholder' => 'Supplier', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}" id="sp_p">
                        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            <select name="id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                <option disabled selected>Pilih Barang...</option>
                                @foreach ( $barang as $key )
                                    <option value="{{ $key->id }}">{{ $key->barang->kode_barang }} - {{ $key->barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantity_po') ? ' has-error' : '' }}">
                        {{ Form::label('Jumlah', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::number('quantity_po',  null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Jumlah']) }}
                            @if($errors->has('quantity_po'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity_po') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                            <a href="{{ url('order-barang/') }}" class="btn btn-success">Selesai</a>
                        </div>
                    </div>

                {!! Form::close() !!}
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang / Kode</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th colspan="2" width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order_barang as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->sotransaksibarang->barang->nama_barang }} - {{ $data->sotransaksibarang->barang->kode_barang }}</td>
                            {!! Form::model($data,
                            ['method' => 'PATCH',
                                'action' => ['PemesananBarangDetailController@update', $data->sotransaksibarang->id],
                                'files' => 'true',
                                'class' => 'form-horizontal']) !!}
                            <td width="15%"><div class="input-group">
                                {{ Form::hidden('po_transaksi_id', $order->id) }}
                                <span class="input-group-addon">{{ $data->sotransaksibarang->quantity_po }} /</span>
                                {{ Form::number('quantity_po',  $data->po_quantity, ['class' => 'form-control', 'placeholder' => 'Jumlah', 'max' => $data->sotransaksibarang->quantity_po + $data->po_quantity, 'min' => '1', 'style' => 'padding-right: 0']) }}
								<span class="input-group-addon">{{ $data->sotransaksibarang->barang->satuan->kode_satuan }}</span>
							</div></td>
                            <td width="25%">{{ $data->sotransaksibarang->keterangan_transaksi }}</td>
                            <td>
                            
                                {!! Form::submit('Perbarui', ['class' => 'btn btn-info']) !!}

                            </td>
                            {!! Form::close() !!}
                            <td>
                            {!! Form::open(['route' => ['transaksi-barang.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
@stop
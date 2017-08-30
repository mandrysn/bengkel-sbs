@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($transaksi, ['method' => 'PATCH', 'action' => [$controller.'@update', $transaksi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {{ Form::label('no_transaksi_material', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('po_transaksi', $transaksi->po_transaksi, ['class' => 'form-control', 'placeholder' => 'No. PO Material', 'disabled']) }}
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
                            {{ Form::date('tanggal_masuk', $transaksi->created_at, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'disabled']) }}
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

                    <div class="form-group">
                        {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('keterangan_transaksi', null, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                            {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                            @if($ma->count() > 0)
                            <a href="{{ route('barang-masuk.index') }}" class="btn btn-success">Selesai</a>
                            @endif
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
                            <th colspan="2" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ma as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->sotransaksibarang->barang->nama_barang }} - {{ $data->sotransaksibarang->barang->kode_barang }}</td>
                            {!! Form::model($data,
                            ['method' => 'PATCH',
                                'action' => ['MaTransaksiDetailController@update', $data->sotransaksibarang->id],
                                'files' => 'true',
                                'class' => 'form-horizontal']) !!}
                            <td width="15%"><div class="input-group">
                                {{ Form::hidden('so_transaksi_barang_id', $data->sotransaksibarang->id) }}
                                {{ Form::hidden('so_transaksi_id', $data->sotransaksibarang->so_transaksi_id) }}
                                {{ Form::number('quantity',  $data->sotransaksibarang->quantity, ['class' => 'form-control', 'placeholder' => 'Jumlah', 'min' => '0', 'style' => 'padding-right: 0']) }}
								<span class="input-group-addon">{{ $data->sotransaksibarang->barang->satuan->kode_satuan }}</span>
							</div></td>
                            <td width="35%">{{ Form::text('keterangan_transaksi', $data->sotransaksibarang->keterangan_transaksi, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}</td>
                            <td>
                            {!! Form::submit('Perbarui', ['class' => 'btn btn-info']) !!}
                            </td>
                            {!! Form::close() !!}
                            <td>
                            {!! Form::open(['route' => ['transaksi-material.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                
                
@stop
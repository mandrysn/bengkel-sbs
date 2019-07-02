@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>


                @include('template.notification')

                {!! Form::model($order, ['method' => 'PATCH', 'action' => [$controller.'@update', $order->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
            
                    <div class="form-group">
                        {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('po_transaksi', $order->po_transaksi, ['class' => 'form-control', 'placeholder' => 'No. PO Material', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('supplier', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('suplier_id', $order->suplier->nama_suplier, ['class' => 'form-control', 'placeholder' => 'Supplier', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('tanggal_pesan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('tanggal_masuk', $order->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'disabled']) }}
                        </div>
                    </div>


                    <div class="form-group">
                        {{ Form::label('nama_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::select('asuransi_id', $asuransi, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih asuransi...', 'data-live-search' => 'true']) }}
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('so_kendaraan_id') ? ' has-error' : '' }}">
                        {{ Form::label('pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            <select name="so_kendaraan_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih kendaraan pelanggan unit...">
                                <option disabled selected>Pilih kendaraan pelanggan...</option>
                                @foreach ( $kendaraan as $key => $attr )
                                <optgroup label="{{ $key }}">
                                    @foreach ( $attr as $pelanggan => $values )
                                    <option value="{{ $pelanggan }}">{{ $values }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            @if($errors->has('so_kendaraan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('so_kendaraan_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('barang_id') ? ' has-error' : '' }}" id="sp_p">
                        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            <select name="barang_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                                <option disabled selected>Pilih Barang...</option>
                                @foreach ( $barang as $key )
                                <option value="{{ $key->id }}">{{ $key->nama_barang }} - {{ $key->no_part_barang }} </option>
                                @endforeach
                            </select>
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
                            {{ Form::label('Diskon', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                    <div class="input-group">
                                {{ Form::text('diskon',  null, ['class' => 'form-control', 'placeholder' => 'Diskon', 'style' => 'padding-right: 0']) }}
                                <span class="input-group-addon">%</span>
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
                            @if($po->count() > 0)
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
                                <th>Nomor Part</th>
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
                    @foreach($po as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->barang->no_part_barang }}</td>
                            <td width="15%">
                                {{ $data->ma_quantity }}
								{{ $data->barang->satuan->kode_satuan }}
                            </td>
                            <td align="right">{{ number_format($data->barang->harga_beli) }}</td>
                            <td>{{ $data->diskon }} %</td>
                            <td align="right">{{ number_format( $hasil = ( $data->barang->harga_beli - ($data->barang->harga_beli * $data->diskon / 100) ) * $data->ma_quantity ) }}</td>
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
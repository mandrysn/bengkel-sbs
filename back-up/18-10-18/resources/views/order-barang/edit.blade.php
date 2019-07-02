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
                            {{ Form::text('tanggal_masuk', $order->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('supplier', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('suplier_id', $order->suplier->nama_suplier, ['class' => 'form-control', 'placeholder' => 'Supplier', 'disabled']) }}
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

                    <div class="form-group{{ $errors->has('barang_id') ? ' has-error' : '' }}">
                        {{ Form::label('nama_barang', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::select('barang_id', $barang, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih barang...', 'data-live-search' => 'true']) }}
                            @if($errors->has('barang_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('barang_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('Jumlah', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::number('quantity',  null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Jumlah']) }}
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
                            <a href="{{ url('order-barang/') }}" class="btn btn-success">Selesai</a>
                        </div>
                    </div>

                {!! Form::close() !!}
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data Pelanggan / Kendaraan</th>
                            <th>Nama Barang / Kode</th>
                            <th>Nomor Part</th>
                            <th>Qty</th>
                            <th>Harga Beli (Rp)</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php ($total_barang = 0)
                    @foreach($order_barang as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->sokendaraan->sopelanggan->nama_pelanggan }} [{{ $data->sokendaraan->no_polisi }}]</td>
                            <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->barang->no_part_barang }}</td>
                            <td width="15%">
                                {{ $data->po_quantity }}
								{{ $data->barang->satuan->kode_satuan }}
                            </td>
                            <td>{{ number_format($data->barang->harga_beli) }}</td>
                            <td>{{ $data->diskon }}</td>
                            <td align="right">{{ number_format( $tagihan_barang = ( $data->barang->harga_beli - ($data->barang->harga_beli * $data->diskon / 100) ) * $data->po_quantity ) }}</td>
                            <td width="15%">{{ $data->keterangan_transaksi }}</td>
                            <td>
                            {!! Form::open(['route' => ['transaksi-order.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            {{ Form::hidden('total',  $total_barang += $tagihan_barang) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" align="right" valign="middle"><h4>total (Rp)</h4></td>
                            <td valign="middle"><h4>{{ number_format($total_barang) }}</h4></td>
                        </tr>
                    </tfoot>
                </table>
                
@stop
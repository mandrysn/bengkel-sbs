@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>

            @if (session()->has('flash_notif.message'))
                <div class="alert alert-{{ session()->get('flash_notif.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>{!! session()->get('flash_notif.message') !!}</p>
                </div>
            @endif

                <ul class="nav nav-tabs">
                    <li><a href="#">Data Pelanggan</a></li>
                    <li><a href="#">Data Kendaraan</a></li>
                    <li class="active"><a href="#transaksi" data-toggle="tab">Data Transaksi</a></li>
                </ul>
                
                <div class="tab-content">
                    <p>&nbsp;</p>
                    <div class="form-horizontal">
                        <div class="form-group">
                            {{ Form::label('Kategori Transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <button id="sp" class="btn btn-primary">Spare Part</button>
                                <button id="jasa" class="btn btn-primary">Jasa</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::model($transaksi, ['method' => 'PATCH', 'action' => ['SoTransaksiController@update', $transaksi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                    <div class="tab-pane" id="transaksi">

                        <div class="form-group{{ $errors->has('no_so_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_so_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $transaksi->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Transaksi', 'disabled']) }}
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_transaksi') }}</strong>
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
                                        <option value="{{ $key->id }}">{{ $key->kode_barang }} - {{ $key->nama_barang }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('barang_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('barang_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kegiatan') ? ' has-error' : '' }}" id="jasa_p">
                            {{ Form::label('kegiatan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('kegiatan', null, ['class' => 'form-control', 'placeholder' => 'Jasa']) }}
                                @if($errors->has('kegiatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kegiatan') }}</strong>
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
                                <a href="{{ route('servis-order.index') }}" class="btn btn-default">Kembali</a>
                                {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                                @if($cjasa > 0 || $cbarang > 0)
                                <a href="{{ url('ekstimasi/' . $transaksi->id . '/edit/') }}" class="btn btn-success">Selesai</a>
                                @endif
                            </div>
                        </div>

                    </div>
                    
                    {!! Form::close() !!}
                </div>
                
                @if($cjasa > 0 || $cbarang > 0)
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pekerjaan / Item</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th colspan="2" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cjasa > 0)
                        <tr>
                            <td colspan="6">Detail Jasa</td>
                        </tr>
                        @endif
                        @foreach($tjasa as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            {!! Form::model($data,
                            ['method' => 'PATCH',
                                'action' => ['SoTransaksiJasaController@update', $data->id],
                                'files' => 'true',
                                'class' => 'form-horizontal']) !!}
                            <td width="15%"><div class="input-group">
                            {{ Form::hidden('jasa_id', $data->id) }}
                            {{ Form::number('quantity',  $data->quantity, ['class' => 'form-control', 'placeholder' => 'Jumlah', 'min' => '0', 'style' => 'padding-right: 0']) }}
                            <span class="input-group-addon">Kali</span>
                            </div></td>
                            <td width="35%">{{ Form::text('keterangan_transaksi', $data->keterangan_transaksi, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}</td>
                            <td>{!! Form::submit('Perbarui', ['class' => 'btn btn-info']) !!}</td>
                            {!! Form::close() !!}
                            <td>
                            {!! Form::open(['route' => ['transaksi-jasa.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                            
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                            {!! Form::close() !!}
                            </td>
                        </tr>
                        
                        @endforeach

                        @if($cbarang > 0)
                        <tr>
                            <td colspan="6">Detail Spare Part</td>
                        </tr>
                        @endif
                        @foreach($tbarang as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            {!! Form::model($data,
                            ['method' => 'PATCH',
                                'action' => ['SoTransaksiBarangController@update', $data->id],
                                'files' => 'true',
                                'class' => 'form-horizontal']) !!}
                            <td width="15%"><div class="input-group">
                            
                                {{ Form::hidden('barang_id', $data->id) }}
                                {{ Form::number('quantity',  $data->quantity, ['class' => 'form-control', 'placeholder' => 'Jumlah', 'min' => '0', 'style' => 'padding-right: 0']) }}
								<span class="input-group-addon">{{ $data->barang->satuan->kode_satuan }}</span>
							</div></td>
                            <td width="35%">{{ Form::text('keterangan_transaksi', $data->keterangan_transaksi, ['class' => 'form-control', 'placeholder' => 'Keterangan']) }}</td>
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
                @endif
               
                <script>
                $(document).ready(function(){
                    $("#sp_p").hide();
                    $("#jasa_p").hide();
                    
                    $("#jasa").click(function(){
                        $("#sp_p").hide();
                        $("#jasa_p").show();
                    });
                    $("#sp").click(function(){
                        $("#sp_p").show();
                        $("#jasa_p").hide();
                    });
                });
                </script>
                
@stop
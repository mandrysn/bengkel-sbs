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
                                <button id="sp" class="btn btn-primary">Spare Part</button>
                                <button id="jasa" class="btn btn-primary">Jasa</button>
                                <button id="material" class="btn btn-primary">Material</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiController@update', $ekstimasi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                    
                        <div class="form-group">
                            {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $ekstimasi->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No. Transaksi', 'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('so_kendaraan_id', $ekstimasi->sokendaraan->sopelanggan->nama_pelanggan, ['class' => 'form-control', 'placeholder' => 'Nama Pelanggan', 'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('barang_id') ? ' has-error' : '' }}" id="material_p">
                            {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="barang_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Material...">
                                    <option disabled selected>Pilih Material...</option>
                                    @foreach ( $materials as $mt )
                                        <option value="{{ $mt->id }}">{{ $mt->no_part_barang }} - {{ $mt->nama_barang }} [Rp {{ number_format($mt->harga_jual) }}]</option>
                                    @endforeach
                                </select>
                                @if($errors->has('barang_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('barang_id') }}</strong>
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
                                        <option value="{{ $key->id }}">{{ $key->no_part_barang }} - {{ $key->nama_barang }} [Rp {{ number_format($key->harga_jual) }}]</option>
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

                        <div class="form-group{{ $errors->has('harga_transaksi') ? ' has-error' : '' }}" id="harga_p">
                            {{ Form::label('harga_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::number('harga_transaksi',  null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Harga Transaksi']) }}
                                @if($errors->has('harga_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harga_transaksi') }}</strong>
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
                                @if($count_jasa > 0 || $count_barang > 0)
                                <a href="{{ route('ekstimasi.index') }}" class="btn btn-success">Selesai</a>
                                @endif
                            </div>
                        </div>
                    {!! Form::close() !!}


                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pekerjaan / Item</th>
                                <th>Qty</th>
                                <th>Biaya per Transaksi (Rp)</th>
                                <th>Diskon (%)</th>
                                <th>Jumlah (Rp)</th>
                                <th>Keterangan</th>
                                <th width="30">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($count_jasa > 0)
                            <tr>
                                <td colspan="6">Detail Jasa</td>
                            </tr>
                            @endif
    
                            @php ($tagihan_jasa = 0)
                            @php ($total = 0)
                            @foreach($detail_jasa as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->kegiatan }}</td>
                                <td>{{ $data->quantity }} Kali</td>
                                <td>
                                    {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiJasaController@update', $data->id], 'class' => 'form-horizontal']) !!}
                                {{ Form::hidden('so_transaksi_id',  $ekstimasi->id) }}
                                {{ Form::number('jasa_harga_transaksi',  $data->harga_transaksi, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Harga Transaksi']) }}
                                </td>
                                <td width="10%">
                                        <div class="input-group">
                                                
                                                {{ Form::text('jasa_diskon',  $data->diskon, ['class' => 'form-control', 'placeholder' => 'Diskon', 'style' => 'padding-right: 0']) }}
                                                <span class="input-group-addon">%</span>
                                                @if($errors->has('diskon'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('diskon') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                </td>
                                <td align="right">{{ number_format( $tagihan_jasa = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                <td>{{ $data->keterangan_transaksi }}</td>
                                <td>

                                    {!! Form::submit('Perbarui', ['class' => 'btn btn-success']) !!}

                                    
                                    {!! Form::close() !!}

                                    {!! Form::open(['route' => ['ekstimasi-jasa.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                                    {!! Form::close() !!}

                                </td>
                                <input type="hidden" name="total" class="form-control" value="{{ $total += $tagihan_jasa }}">
                            </tr>
                            
                            @endforeach
                            @if($count_jasa > 0)
                            <tr>
                                <td colspan="5" align="right" valign="middle"><h5>total jasa (Rp)</h5></td>
                                <td valign="middle"><h5>{{ number_format($total) }}</h5></td>
                                <td colspan="1">&nbsp;</td>
                            </tr>
                            @endif

                            @if($count_barang > 0)
                            <tr>
                                <td colspan="7">Detail Barang</td>
                                
                                <td></td>
                            </tr>
                            @endif
    
                            @php ($tagihan_barang = 0)
                            @php ($total_barang = 0)
                            @foreach($detail_barang as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                <td>
                                    {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiBarangController@update', $data->id], 'class' => 'form-horizontal']) !!}
                                {{ Form::hidden('so_transaksi_id',  $ekstimasi->id) }}
                                {{ Form::number('barang_harga_transaksi',  $data->harga_transaksi, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Harga Transaksi']) }}
                                </td>
                                <td width="10%">
                                        <div class="input-group">
                                                
                                                {{ Form::text('barang_diskon',  $data->diskon, ['class' => 'form-control', 'placeholder' => 'Diskon', 'style' => 'padding-right: 0']) }}
                                                <span class="input-group-addon">%</span>
                                                @if($errors->has('barang_diskon'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('barang_diskon') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                </td>
                                <td align="right">{{ number_format( $tagihan_barang = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                <td>{{ $data->keterangan_transaksi }}</td>
                                <td>
                                    
                                        {!! Form::submit('Perbarui', ['class' => 'btn btn-success']) !!}

                                    
                                    {!! Form::close() !!}

                                    {!! Form::open(['route' => ['ekstimasi-barang.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                                    {!! Form::close() !!}

                                </td>
                                {{ Form::hidden('total',  $total_barang += $tagihan_barang) }}
                            </tr>
                            
                            @endforeach
                            @if($count_barang > 0)
                            <tr>
                                <td colspan="5" align="right" valign="middle"><h5>total barang (Rp)</h5></td>
                                <td valign="middle"><h5>{{ number_format($total_barang) }}</h5></td>
                            </tr>
                            @endif

                            @if($count_material > 0)
                            <tr>
                                <td colspan="7">Detail Material</td>
                                
                                <td></td>
                            </tr>
                            @endif
    
                            @php ($tagihan_material = 0)
                            @php ($total_material = 0)
                            @foreach($detail_material as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                <td>
                                    {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiBarangController@update', $data->id], 'class' => 'form-horizontal']) !!}
                                {{ Form::hidden('so_transaksi_id',  $ekstimasi->id) }}
                                {{ Form::number('barang_harga_transaksi',  $data->harga_transaksi, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Harga Transaksi']) }}
                                </td>
                                <td width="10%">
                                        <div class="input-group">
                                                
                                                {{ Form::text('barang_diskon',  $data->diskon, ['class' => 'form-control', 'placeholder' => 'Diskon', 'style' => 'padding-right: 0']) }}
                                                <span class="input-group-addon">%</span>
                                                @if($errors->has('barang_diskon'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('barang_diskon') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                </td>
                                <td align="right">{{ number_format( $tagihan_material = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                <td>{{ $data->keterangan_transaksi }}</td>
                                <td>
                                    
                                        {!! Form::submit('Perbarui', ['class' => 'btn btn-success']) !!}

                                    
                                    {!! Form::close() !!}

                                    {!! Form::open(['route' => ['ekstimasi-barang.destroy', $data->id], 'method' => 'delete', 'class' => 'form-inline', 'id' => "delete-form"]) !!}
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirmation();"]) !!}

                                    {!! Form::close() !!}

                                </td>
                                {{ Form::hidden('total',  $total_material += $tagihan_material) }}
                            </tr>
                            
                            @endforeach
                            @if($count_material > 0)
                            <tr>
                                <td colspan="5" align="right" valign="middle"><h5>total material (Rp)</h5></td>
                                <td valign="middle"><h5>{{ number_format($total_material) }}</h5></td>
                            </tr>
                            @endif
    
    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" align="right" valign="middle"><h4>total (Rp)</h4></td>
                                <td valign="middle"><h4>{{ number_format($total_barang + $total + $total_material) }}</h4></td>
                            </tr>
							
							<tr>
                                <td colspan="5" align="right" valign="middle"><h6>PPN (%)</h6></td>
                                <td valign="middle">
                                    
                                    {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiPpnController@update', $ekstimasi->id], 'class' => 'form-horizontal']) !!}
                                
                                <div class="input-group">
                                    {{ Form::hidden('so_transaksi_id',  $ekstimasi->id) }}
                                                {{ Form::text('ppn',  $ekstimasi->ppn == null ? "0" : $ekstimasi->ppn, ['class' => 'form-control', 'placeholder' => 'PPN', 'style' => 'padding-right: 0']) }}
                                                <span class="input-group-addon">%</span>
                                                </div>
	
                                </td>
								 <td>
                                    

{!! Form::submit('Perbarui', ['class' => 'btn btn-success']) !!}

                                    
                                    {!! Form::close() !!}

                                </td>
                            </tr>
							<tr>
                                <td colspan="5" align="right" valign="middle"><h4>grand total (Rp)</h4></td>
                                <td valign="middle"><h4>{{ number_format( ($total_barang + $total + $total_material) + ( ($ekstimasi->ppn / 100) * ($total_barang + $total + $total_material) ) ) }}</h4></td>
                            </tr>
                        </tfoot>
                    </table>
               
                <script>
                $(document).ready(function(){
                    $("#sp_p").hide();
                    $("#jasa_p").hide();
                    $("#harga_p").hide();
                    $("#material_p").hide();
                    
                    $("#jasa").click(function(){
                        $("#sp_p").hide();
                        $("#jasa_p").show();
                        $("#harga_p").show();
                        $("#material_p").hide();
                    });
                    $("#sp").click(function(){
                        $("#sp_p").show();
                        $("#jasa_p").hide();
                        $("#harga_p").hide();
                        $("#material_p").hide();
                    });
                    $("#material").click(function(){
                        $("#material_p").show();
                        $("#jasa_p").hide();
                        $("#sp_p").hide();
                        $("#harga_p").hide();
                    });
                });
                </script>
                
@stop
<div class="form-horizontal">
                    <div class="form-group">
                        {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('no_transaksi', $ekstimasi->no_transaksi, ['class' => 'form-control', 'placeholder' => 'No SO Transaksi', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('tanggal_masuk', $ekstimasi->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Tanggal Masuk', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('no_claim', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('no_claim', $ekstimasi->sokendaraan->sopelanggan->no_claim, ['class' => 'form-control', 'placeholder' => 'No Claim', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('no_polisi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('no_polisi', $ekstimasi->sokendaraan->no_polisi, ['class' => 'form-control', 'placeholder' => 'No Polisi', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ url('ekstimasi') }}" class="btn btn-primary">Selesai</a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pekerjaan / Item</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
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

                        {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiJasaController@update', $ekstimasi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                        @php ($tagihan_jasa = 0)
                        @foreach($detail_jasa as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            <td>{{ $data->quantity }} Kali</td>
                            <td>
                            
                            <input type="hidden" id="so_transaksi_jasa_id" name="jasa[{{ $index }}][id]" class="form-control" value="{{ $data->id }}">
                            <input type="hidden" id="total_jasa" name="total_jasa" class="form-control" value="{{ $hasil_jasa = $data->quantity * $data->harga_transaksi }}">
                            <input type="hidden" id="quantity" name="jasa[{{ $index }}][quantity]" class="form-control" value="{{ $data->quantity }}">
                            <input type="number" id="harga_transaksi" name="jasa[{{ $index }}][harga_transaksi]" class="form-control" value="{{ $data->harga_transaksi }}">
                            </td>
                            <td>{{ number_format($data->quantity * $data->harga_transaksi) }}
                            <input type="hidden" id="total" name="tagihan_jasa" class="form-control" value="{{ $tagihan_jasa += $hasil_jasa }}"></td>
                            <td>{{ $data->keterangan_transaksi }}</td>
                        </tr>
                        
                        @endforeach
                        @if($count_jasa > 0)
                        <tr>
                            <td colspan="3" align="right">total diskon</td>
                            <td>{{ Form::number('diskon_jasa', $tagihan->diskon_jasa, ['class' => 'form-control', 'placeholder' => 'Diskon Jasa']) }}</td>
                            <td>{{ $jumlah_jasa = number_format($tagihan_jasa - $tagihan->diskon_jasa) }}</td>
                            <input type="hidden" id="jumlah_jasa" name="jumlah_jasa" class="form-control" value="{{ $tagihan_jasa - $tagihan->diskon_jasa }}"></td>
                            <td>&nbsp;</td>
                            <td>{!! Form::submit($button, ['class' => 'btn btn-success']) !!}</td>
                        </tr>
                        @endif
                        {!!  Form::close() !!}

                        @if($count_barang > 0)
                        <tr>
                            <td colspan="6">Detail Spare Part</td>
                        </tr>
                        @endif

                        {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiBarangController@update', $ekstimasi->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                        @php ($tagihan_sparepart = 0)
                        @foreach($detail_barang as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                            <td>
                            
                            <input type="hidden" id="so_transaksi_barang_id" name="barang[{{ $index }}][id]" class="form-control" value="{{ $data->id }}">
                            <input type="number" id="harga_transaksi" name="barang[{{ $index }}][harga_transaksi]" class="form-control" value="{{ $data->harga_transaksi }}">
                            <input type="hidden" id="quantity" name="barang[{{ $index }}][quantity]" class="form-control" value="{{ $data->quantity }}">
                            <input type="hidden" id="total_sparepart" name="total_sparepart" class="form-control" value="{{ $hasil_sparepart = $data->quantity * $data->harga_transaksi }}">
                            </td>
                            <td>{{ number_format($data->quantity * $data->harga_transaksi) }}</td>
                            <td>{{ $data->keterangan_transaksi }}
                            <input type="hidden" id="tagihan_sparepart" name="tagihan_sparepart" class="form-control" value="{{ $tagihan_sparepart += $hasil_sparepart }}">
                            </td>
                            
                        </tr>
                        
                        @endforeach
                        @if($count_barang > 0)
                        <tr>
                            <td colspan="3" align="right">total diskon</td>
                            <td>{{ Form::number('diskon_sparepart', $tagihan->diskon_sparepart, ['class' => 'form-control', 'placeholder' => 'Diskon Sparepart']) }}</td>
                            <td>{{ $jumlah_sparepart = number_format($tagihan_sparepart - $tagihan->diskon_sparepart) }}
                            <input type="hidden" id="jumlah_sparepart" name="jumlah_sparepart" class="form-control" value="{{ $tagihan_sparepart - $tagihan->diskon_sparepart }}"></td></td>
                            <td>&nbsp;</td>
                            <td>{!! Form::submit($button, ['class' => 'btn btn-success']) !!}</td>
                        </tr>
                        @endif
                        {!!  Form::close() !!}
                    </tbody>
                    <tfoot></tfoot>
                </table>
                
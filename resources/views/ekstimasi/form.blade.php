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
                            {{ Form::text('tanggal_masuk', $ekstimasi->sokendaraan->tanggal_masuk, ['class' => 'form-control', 'placeholder' => 'Tanggal Masuk', 'disabled']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('no_claim', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('no_claim', $ekstimasi->sopelanggan->no_claim, ['class' => 'form-control', 'placeholder' => 'No Claim', 'disabled']) }}
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
                            <a href="{{ url('order-barang') }}" class="btn btn-primary">Selesai</a>
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
                        @foreach($detail_jasa as $index => $data)
                        {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiJasaController@update', $data->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            <td>{{ $data->quantity }} Kali</td>
                            <td>
                            {{ Form::hidden('so_transaksi_jasa_id', $data->id) }}
                            {{ Form::hidden('so_transaksi_id', $ekstimasi->id) }}
                            {{ Form::number('harga_transaksi', $data->harga_transaksi, ['class' => 'form-control', 'placeholder' => 'Harga Jasa']) }}</td>
                            <td>{{ $data->keterangan_transaksi }}</td>
                            <td>{!! Form::submit($button, ['class' => 'btn btn-success']) !!}</td>
                        </tr>
                        {!!  Form::close() !!}
                        @endforeach
                        @if($count_barang > 0)
                        <tr>
                            <td colspan="6">Detail Spare Part</td>
                        </tr>
                        @endif
                        @foreach($detail_barang as $index => $data)
                        {!! Form::model($ekstimasi, ['method' => 'PATCH', 'action' => ['EkstimasiBarangController@update', $data->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                            <td>
                            {{ Form::hidden('so_transaksi_barang_id', $data->id) }}
                            {{ Form::hidden('so_transaksi_id', $ekstimasi->id) }}
                            {{ Form::number('harga_transaksi', $data->harga_transaksi, ['class' => 'form-control', 'placeholder' => 'Harga Barang']) }}
                            </td>
                            <td>{{ $data->keterangan_transaksi }}</td>
                            <td>{!! Form::submit($button, ['class' => 'btn btn-success']) !!}</td>
                        </tr>
                        {!!  Form::close() !!}
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
                
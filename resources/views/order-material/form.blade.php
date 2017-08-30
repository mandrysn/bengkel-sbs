                    {{ Form::hidden('no_transaksi', $noma, ['class' => 'form-control', 'placeholder' => 'No. PO Material', 'readonly']) }}
                    <div class="form-group{{ $errors->has('po_transaksi') ? ' has-error' : '' }}">
                        {{ Form::label('no_transaksi_material', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('po_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. PO Material', 'readonly']) }}
                            @if($errors->has('po_transaksi'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('po_transaksi') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                        {{ Form::label('tanggal_pesan', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'required']) }}
                            @if($errors->has('tanggal_masuk'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('suplier_id') ? ' has-error' : '' }}">
                        {{ Form::label('supplier', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::select('suplier_id', $suplier, null, ['id' => 'id', 'class' => 'form-control selectpicker', 'placeholder' => 'Pilih Supplier...', 'data-live-search' => 'true']) }}
                            @if($errors->has('suplier_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('suplier_id') }}</strong>
                                </span>
                            @endif
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
                        </div>
                    </div>
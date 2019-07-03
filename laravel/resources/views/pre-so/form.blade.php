                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. Pre SO', 'readonly']) }}
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('so_kendaraan_id') ? ' has-error' : '' }}">
                            {{ Form::label('pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('nama_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci', 'id' => 'data_pelanggan', 'readonly']) }}
                                {{ Form::hidden('so_kendaraan_id', null, ['id' => 'so_kendaraan_id']) }}
                                @if($errors->has('so_kendaraan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('so_kendaraan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-1">
                                <a href="javascript:void(0);" class="btn btn-default" name="Pencarian Pelanggan" title="SBS - Pencarian Pelanggan" onClick='javascript:window.open("{{ route('pre-so.cari.pelanggan') }}", "Ratting", "width=950,height=370,toolbar=1,status=1,");'>Cari</a>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal_pre') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_pre', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                                @if($errors->has('tanggal_pre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_pre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
					<div class="form-group">
                        {{ Form::label('nama_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            {{ Form::text('nama_asuransi', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci', 'id' => 'data_asuransi', 'readonly']) }}
                            {{ Form::hidden('asuransi_id', null, ['id' => 'asuransi_id']) }}
                                @if($errors->has('so_kendaraan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('so_kendaraan_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-1">
                                <a href="javascript:void(0);" class="btn btn-default" name="Pencarian Asuransi" title="SBS - Pencarian Asuransi" onClick='javascript:window.open("{{ route('pre-so.cari.asuransi') }}", "Ratting", "width=950,height=370,toolbar=1,status=1,");'>Cari</a>
                            </div>
                    </div>
                        
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                        {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                        
                    </div>
                </div>
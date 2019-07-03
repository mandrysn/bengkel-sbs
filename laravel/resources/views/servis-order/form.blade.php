                        <div class="form-group{{ $errors->has('no_transaksi') ? ' has-error' : '' }}">
                            {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. Transaksi', 'readonly']) }}
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('nomor_pre_so', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('nomor_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci', 'id' => 'data_pelanggan', 'readonly']) }}
                                {{ Form::hidden('id', null, ['id' => 'id_pelanggan']) }}
                            </div>
                            <div class="col-lg-1">
                                <a href="javascript:void(0);" class="btn btn-default" name="Pencarian SPK" title="SBS - Pencarian SPK" onClick='javascript:window.open("{{ route('servis-order.cari.spk') }}", "Ratting", "width=950,height=370,toolbar=1,status=1,");'>Cari</a>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('tanggal_so') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_so', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                                @if($errors->has('tanggal_so'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_so') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group">
                            {{ Form::label('tanggal_keluar', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_claim', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                                {!! Form::submit('Buat SO', ['class' => 'btn btn-primary']) !!}
                                
                            </div>
                        </div>
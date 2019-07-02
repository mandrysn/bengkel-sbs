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

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            {{ Form::label('nomor_pre_so', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih merek unit...">
                                    <option disabled selected>Pilih nomor pre servis order...</option>
                                    @foreach ( $pre_so as $key => $attr )
                                    <optgroup label="{{ $key }}">
                                        @foreach ( $attr as $bid => $values )
                                        <option value="{{ $bid }}">{{ $values }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                                @if($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
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
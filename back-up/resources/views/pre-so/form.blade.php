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
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                        {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                        
                    </div>
                </div>
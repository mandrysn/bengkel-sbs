                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            {{ Form::label('pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih kendaraan pelanggan unit...">
                                    <option disabled selected>Pilih kendaraan pelanggn unit...</option>
                                    @foreach ( $kendaraan as $key => $attr )
                                    <optgroup label="{{ $key }}">
                                        @foreach ( $attr as $pelanggan => $values )
                                        <option value="{{ $pelanggan }}">{{ $values }}</option>
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

                        <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...']) }}
                                @if($errors->has('tanggal_masuk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('tanggal_selesai') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal_ekstimasi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_selesai', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal selesai...']) }}
                                @if($errors->has('tanggal_selesai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_selesai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
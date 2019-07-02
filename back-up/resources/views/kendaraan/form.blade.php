                        <div class="form-group{{ $errors->has('so_pelanggan_id') ? ' has-error' : '' }}">
                            {{ Form::label('nama_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::select('so_pelanggan_id', $pelanggan, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih nama pelanggan...', 'data-live-search' => 'true']) }}
                                @if($errors->has('so_pelanggan_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('so_pelanggan_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('no_polisi') ? ' has-error' : '' }}">
                            {{ Form::label('no_polisi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_polisi', null, ['class' => 'form-control', 'placeholder' => 'No. Polisi']) }}
                                @if($errors->has('no_polisi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_polisi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('no_rangka') ? ' has-error' : '' }}">
                            {{ Form::label('no_rangka', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_rangka', null, ['class' => 'form-control', 'placeholder' => 'No. Rangka']) }}
                                @if($errors->has('no_rangka'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_rangka') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('no_mesin') ? ' has-error' : '' }}">
                            {{ Form::label('no_mesin', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_mesin', null, ['class' => 'form-control', 'placeholder' => 'No. Mesin']) }}
                                @if($errors->has('no_mesin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_mesin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('merek_id') ? ' has-error' : '' }}">
                            {{ Form::label('unit_merek', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="merek_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih merek unit...">
                                    <option disabled selected>Pilih merek unit...</option>
                                    @foreach ( $merek as $key => $attr )
                                    <optgroup label="{{$key}}">
                                        @foreach ( $attr as $bid => $values )
                                        <option value="{{ $bid }}">{{ $values }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                                @if($errors->has('merek_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('merek_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('warna_kendaraan') ? ' has-error' : '' }}">
                            {{ Form::label('warna_kendaraan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('warna_kendaraan', null, ['class' => 'form-control', 'placeholder' => 'Warna Kendaraan']) }}
                                @if($errors->has('warna_kendaraan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('warna_kendaraan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tahun_kendaraan') ? ' has-error' : '' }}">
                            {{ Form::label('tahun_kendaraan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('tahun_kendaraan', null, ['class' => 'form-control', 'placeholder' => 'Tahun Kendaraan']) }}
                                @if($errors->has('tahun_kendaraan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun_kendaraan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('km_kendaraan') ? ' has-error' : '' }}">
                            {{ Form::label('km_kendaraan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::number('km_kendaraan',  null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'KM Kendaraan']) }}
                                @if($errors->has('km_kendaraan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('km_kendaraan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto_depan') ? ' has-error' : '' }}">
                            {{ Form::label('foto', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::file('foto_depan', null, ['class' => 'form-control']) }}
                                @if($errors->has('foto_depan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto_depan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @include('template.button-form')
@if ( Request::segment(2) == 'create')

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pelanggan" data-toggle="tab">Data Pelanggan</a></li>
                    <li><a href="#kendaraan" data-toggle="tab">Data Kendaraan</a></li>
                    <li><a href="#">Data Transaksi</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="pelanggan">
                        <p>&nbsp;</p>
                        {{ Form::hidden('tahun', date('Y')) }}
                        <div class="form-group{{ $errors->has('no_claim') ? ' has-error' : '' }}">
                            {{ Form::label('no_claim', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_claim', null, ['class' => 'form-control', 'placeholder' => 'No. Claim']) }}
                                @if($errors->has('no_claim'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_claim') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nama_pelanggan') ? ' has-error' : '' }}">
                            {{ Form::label('nama_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('nama_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'Nama Pelanggan']) }}
                                @if($errors->has('nama_pelanggan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_pelanggan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('no_telpon_pelanggan') ? ' has-error' : '' }}">
                            {{ Form::label('no_telpon_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_telpon_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'No. Telpon Pelanggan']) }}
                                @if($errors->has('no_telpon_pelanggan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_telpon_pelanggan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('alamat_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('alamat_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'Alamat Pelanggan']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('nama_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::select('asuransi_id', $asuransi, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih asuransi...', 'data-live-search' => 'true']) }}
                            </div>
                        </div>
                        
                    </div>

                    <div class="tab-pane" id="kendaraan">
                        <p>&nbsp;</p>
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
                                {{ Form::number('km_kendaraan',  null, ['class' => 'form-control', 'placeholder' => 'KM Kendaraan']) }}
                                @if($errors->has('km_kendaraan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('km_kendaraan') }}</strong>
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
                            {{ Form::label('tanggal_selesai', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_selesai', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal selesai...']) }}
                                @if($errors->has('tanggal_selesai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_selesai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto_depan') ? ' has-error' : '' }}">
                            {{ Form::label('foto_depan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::file('foto_depan', null, ['class' => 'form-control']) }}
                                @if($errors->has('foto_depan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto_depan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto_belakang') ? ' has-error' : '' }}">
                            {{ Form::label('foto_belakang', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::file('foto_belakang', null, ['class' => 'form-control']) }}
                                @if($errors->has('foto_belakang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto_belakang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto_kanan') ? ' has-error' : '' }}">
                            {{ Form::label('foto_kanan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::file('foto_kanan', null, ['class' => 'form-control']) }}
                                @if($errors->has('foto_kanan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto_kanan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto_kiri') ? ' has-error' : '' }}">
                            {{ Form::label('foto_kiri', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::file('foto_kiri', null, ['class' => 'form-control']) }}
                                @if($errors->has('foto_kiri'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto_kiri') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @include('template.button-form')
                    </div>

                </div>
@endif
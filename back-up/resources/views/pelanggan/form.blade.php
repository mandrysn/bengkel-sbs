
                        <div class="form-group{{ $errors->has('no_claim') ? ' has-error' : '' }}">
                        {{ Form::label('no_identitas', null, ['class' => 'col-lg-2 control-label']) }}
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

                        @include('template.button-form')
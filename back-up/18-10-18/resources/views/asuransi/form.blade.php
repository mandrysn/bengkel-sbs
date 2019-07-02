                <div class="form-group{{ $errors->has('kode_asuransi') ? ' has-error' : '' }}">
                    {{ Form::label('kode_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_asuransi', null, ['class' => 'form-control', 'placeholder' => 'Kode Asuransi', 'autofocus']) }}
                        @if($errors->has('kode_asuransi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kode_asuransi') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('nama_asuransi') ? ' has-error' : '' }}">
                    {{ Form::label('nama_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_asuransi', null, ['class' => 'form-control', 'placeholder' => 'Nama Asuransi']) }}
                        @if($errors->has('nama_asuransi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_asuransi') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('alamat_asuransi') ? ' has-error' : '' }}">
                    {{ Form::label('alamat_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('alamat_asuransi', null, ['class' => 'form-control', 'placeholder' => 'Alamat Asuransi']) }}
                        @if($errors->has('alamat_asuransi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat_asuransi') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('no_telpon_asuransi') ? ' has-error' : '' }}">
                    {{ Form::label('no_telpon_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('no_telpon_asuransi', null, ['class' => 'form-control', 'placeholder' => 'No. Telpon Asuransi']) }}
                        @if($errors->has('no_telpon_asuransi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('no_telpon_asuransi') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('no_hp_asuransi', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('no_hp_asuransi', null, ['class' => 'form-control', 'placeholder' => 'No. Hp Asuransi']) }}
                    </div>
                </div>
                
                @include('template.button-form')
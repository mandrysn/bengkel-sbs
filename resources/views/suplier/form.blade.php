                <div class="form-group{{ $errors->has('kode_suplier') ? ' has-error' : '' }}">
                    {{ Form::label('kode_suplier', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_suplier', $kode, ['class' => 'form-control', 'placeholder' => 'Kode Supplier', 'readonly']) }}
                        @if($errors->has('kode_asuransi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kode_suplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('nama_suplier') ? ' has-error' : '' }}">
                    {{ Form::label('nama_suplier', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_suplier', null, ['class' => 'form-control', 'placeholder' => 'Nama Supplier', 'autofocus']) }}
                        @if($errors->has('nama_suplier'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_suplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('alamat_suplier') ? ' has-error' : '' }}">
                    {{ Form::label('alamat_suplier', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('alamat_suplier', null, ['class' => 'form-control', 'placeholder' => 'Alamat Supplier']) }}
                        @if($errors->has('alamat_suplier'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat_suplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('no_telpon_suplier') ? ' has-error' : '' }}">
                    {{ Form::label('no_telpon_suplier', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('no_telpon_suplier', null, ['class' => 'form-control', 'placeholder' => 'No. Telpon Supplier']) }}
                        @if($errors->has('no_telpon_suplier'))
                            <span class="help-block">
                                <strong>{{ $errors->first('no_telpon_suplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('no_hp_suplier', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('no_hp_suplier', null, ['class' => 'form-control', 'placeholder' => 'No. Hp Asuransi']) }}
                    </div>
                </div>
                
                @include('template.button-form')
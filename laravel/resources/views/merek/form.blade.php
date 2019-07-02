                <div class="form-group{{ $errors->has('kode_merek') ? ' has-error' : '' }}">
                    {{ Form::label('kode_merek', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_merek', null, ['class' => 'form-control', 'placeholder' => 'Kode Merek', 'autofocus']) }}
                        @if($errors->has('kode_merek'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kode_merek') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('nama_merek') ? ' has-error' : '' }}">
                    {{ Form::label('Nama_merek', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_merek', null, ['class' => 'form-control', 'placeholder' => 'Nama Merek']) }}
                        @if($errors->has('nama_merek'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_merek') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('unit_merek') ? ' has-error' : '' }}">
                    {{ Form::label('unit_merek', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('unit_merek', null, ['class' => 'form-control', 'placeholder' => 'Unit Merek']) }}
                        @if($errors->has('unit_merek'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unit_merek') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @include('template.button-form')
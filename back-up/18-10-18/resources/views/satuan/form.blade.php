                <div class="form-group{{ $errors->has('kode_satuan') ? ' has-error' : '' }}">
                    {{ Form::label('kode_satuan', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_satuan', null, ['class' => 'form-control', 'placeholder' => 'Kode Satuan', 'autofocus']) }}
                        @if($errors->has('kode_satuan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kode_satuan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('nama_satuan') ? ' has-error' : '' }}">
                    {{ Form::label('nama_satuan', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_satuan', null, ['class' => 'form-control', 'placeholder' => 'Nama Satuan']) }}
                        @if($errors->has('nama_satuan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_satuan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                @include('template.button-form')

                <div class="form-group{{ $errors->has('nama_operasional') ? ' has-error' : '' }}">
                    {{ Form::label('nama_operasional', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_operasional', null, ['class' => 'form-control', 'placeholder' => 'Nama Operasional', 'autofocus']) }}
                        @if($errors->has('nama_operasional'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_operasional') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @include('template.button-form')
                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            {{ Form::label('nomor_servis_order', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                <select name="id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih merek unit...">
                                    <option disabled selected>Pilih nomor servis order...</option>
                                    @foreach ( $invoice as $key => $attr )
                                    <optgroup label="{{ $key }}">
                                        @foreach ( $attr as $bid => $values )
                                        <option value="{{ $bid }}">{{ $values }}</option>
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

                        <div class="form-group{{ $errors->has('tanggal_invoice') ? ' has-error' : '' }}">
                            {{ Form::label('tanggal', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::date('tanggal_invoice', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal...']) }}
                                @if($errors->has('tanggal_invoice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_invoice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group">
                    {{ Form::label('PPN', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        <div class="input-group">
                            {{ Form::number('ppn',  null, ['class' => 'form-control', 'placeholder' => 'PPN %', 'min' => '0', 'max' => '100']) }}
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
						
						
                        

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                                {!! Form::submit('Buat Pre Invoice', ['class' => 'btn btn-primary']) !!}
                                
                            </div>
                        </div>
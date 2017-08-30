                <div class="form-group{{ $errors->has('kode_barang') ? ' has-error' : '' }}">
                    {{ Form::label('kode_barang', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_barang', $kode, ['class' => 'form-control', 'placeholder' => 'Kode Barang', 'readonly']) }}
                        @if($errors->has('kode_barang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kode_barang') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('no_part_barang') ? ' has-error' : '' }}">
                    {{ Form::label('no_part_barang', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('no_part_barang', null, ['class' => 'form-control', 'placeholder' => 'No. Part Barang', 'autofocus']) }}
                        @if($errors->has('no_part_barang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('no_part_barang') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                    {{ Form::label('nama_barang', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_barang', null, ['class' => 'form-control', 'placeholder' => 'Nama Barang']) }}
                        @if($errors->has('nama_barang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_barang') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('kategori_barang') ? ' has-error' : '' }}">
                    {{ Form::label('kategori_barang', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::select('kategori_barang', ['1' => 'Material', '2' => 'Spare Part'], null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih kategori barang...', 'data-live-search' => 'false']) }}
                        @if($errors->has('kategori_barang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kategori_barang') }}</strong>
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
                
                <div class="form-group{{ $errors->has('harga_barang') ? ' has-error' : '' }}">
                    {{ Form::label('harga_barang', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('harga_barang', null, ['class' => 'form-control', 'placeholder' => 'Harga Barang']) }}
                        @if($errors->has('harga_barang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga_barang') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('satuan_id') ? ' has-error' : '' }}">
                    {{ Form::label('satuan_barang', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::select('satuan_id', $satuan, null, ['class' => 'form-control selectpicker', 'placeholder' => 'Pilih satuan barang...', 'data-live-search' => 'false']) }}
                        @if($errors->has('satuan_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('satuan_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                    {{ Form::label('keterangan', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('keterangan', null, ['class' => 'form-control', 'placeholder' => 'keterangan']) }}
                        @if($errors->has('keterangan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('keterangan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                
                @include('template.button-form')
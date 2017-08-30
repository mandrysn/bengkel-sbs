                <div class="form-group">
                    {{ Form::label('kode_merek', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_merek', null, ['class' => 'form-control', 'placeholder' => 'Kode Merek', 'required']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('Nama_merek', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('nama_merek', null, ['class' => 'form-control', 'placeholder' => 'Nama Merek', 'required']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('unit_merek', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('unit_merek', null, ['class' => 'form-control', 'placeholder' => 'Unit Merek', 'required']) }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input type="button" value="Batal" class="btn btn-default" onclick="self.history.back()">
                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Data Pelanggan</a></li>
                    <li><a href="#">Data Kendaraan</a></li>
                    <li><a href="#">Data Transaksi</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="pelanggan">
                        <p>&nbsp;</p>
                        {!! Form::open(['url' => 'pelanggan-order', 'files' => 'true', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {{ Form::label('no_claim', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_claim', null, ['class' => 'form-control', 'placeholder' => 'No. Claim']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('nama_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('nama_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'Nama Pelanggan']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('no_telpon_pelanggan', null, ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-3">
                                {{ Form::text('no_telpon_pelanggan', null, ['class' => 'form-control', 'placeholder' => 'No. Telpon Pelanggan']) }}
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
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::button('Batal', ['class' => 'btn btn-default', 'onclick' => "self.history.back()"]) !!}
                                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
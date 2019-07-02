                        {{ Form::hidden('kode_tagihan', $kode) }}
                <div class="form-group{{ $errors->has('so_transaksi_id') ? ' has-error' : '' }}">
                        {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-3">
                            <select name="so_transaksi_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Transaksi...">
                                <option disabled selected>Pilih Transaksi...</option>
                                @foreach ( $transaksi as $key )
                                    <option value="{{ $key->id }}">{{ $key->no_transaksi }} - [{{ $key->sokendaraan->no_polisi }}] {{ $key->sokendaraan->sopelanggan->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('so_transaksi_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('so_transaksi_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>  

                <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                    {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'required']) }}
                        @if($errors->has('tanggal_masuk'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('jumlah_or') ? ' has-error' : '' }}">
                    {{ Form::label('biaya', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::number('jumlah_or',  null, ['class' => 'form-control', 'placeholder' => 'Biaya', 'min' => '0']) }}
                    </div>
                    @if($errors->has('jumlah_or'))
                        <span class="help-block">
                            <strong>{{ $errors->first('jumlah_or') }}</strong>
                        </span>
                    @endif
                </div>
                
                @include('template.button-form')
                
<div class="form-group{{ $errors->has('bbk_transaksi') ? ' has-error' : '' }}">
    {{ Form::label('no_barang_keluar', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::text('bbk_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. Bukti Barang Masuk', 'readonly']) }}
        @if($errors->has('bk_transaksi'))
            <span class="help-block">
                <strong>{{ $errors->first('bbk_transaksi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
    {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...']) }}
                    @if($errors->has('tanggal_masuk'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_masuk') }}</strong>
                                </span>
                            @endif
    </div>
</div>


<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
        {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            <select name="id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
                <option disabled selected>Pilih Barang...</option>
                @foreach ( $barang as $key )
                    <option value="{{ $key->id }}">{{ $key->suplier->nama_suplier }}. {{ $key->barang->kode_barang }} - {{ $key->barang->nama_barang }}</option>
                @endforeach
            </select>
            @if($errors->has('id'))
                <span class="help-block">
                    <strong>{{ $errors->first('id') }}</strong>
                </span>
            @endif
        </div>
    </div>

@include('template.button-form')
<div class="form-group{{ $errors->has('bbm_material') ? ' has-error' : '' }}">
    {{ Form::label('no_barang_masuk', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::text('bbm_material', $kode, ['class' => 'form-control', 'placeholder' => 'No. Bukti Material Masuk', 'readonly']) }}
        @if($errors->has('bbm_material'))
            <span class="help-block">
                <strong>{{ $errors->first('bbm_material') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'required']) }}
    </div>
</div>

<div class="form-group{{ $errors->has('material_id') ? ' has-error' : '' }}">
    {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
            <select name="material_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Transaksi...">
                    <option disabled selected>Pilih Pemesanan...</option>
                    @foreach ( $notransaksi as $key )
                        <option value="{{ $key->id }}">{{ $key->ma_transaksi }} - {{ $key->suplier->nama_suplier }}</option>
                    @endforeach
                </select>
        @if($errors->has('material_id'))
            <span class="help-block">
                <strong>{{ $errors->first('material_id') }}</strong>
            </span>
        @endif
    </div>
</div>

@include('template.button-form')
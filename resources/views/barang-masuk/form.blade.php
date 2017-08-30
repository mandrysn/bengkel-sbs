<div class="form-group{{ $errors->has('bm_transaksi') ? ' has-error' : '' }}">
    {{ Form::label('no_barang_masuk', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::text('bm_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. Bukti Barang Masuk', 'readonly']) }}
        @if($errors->has('bm_transaksi'))
            <span class="help-block">
                <strong>{{ $errors->first('bm_transaksi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...']) }}
    </div>
</div>

<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
    {{ Form::label('no_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::select('id', $notransaksi, null, ['id' => 'id', 'class' => 'form-control selectpicker', 'placeholder' => 'Pilih Nomor PO...', 'data-live-search' => 'true']) }}
        @if($errors->has('id'))
            <span class="help-block">
                <strong>{{ $errors->first('id') }}</strong>
            </span>
        @endif
    </div>
</div>

@include('template.button-form')
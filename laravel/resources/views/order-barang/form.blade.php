<div class="form-group{{ $errors->has('po_transaksi') ? ' has-error' : '' }}">
    {{ Form::label('no_po_transaksi', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::text('po_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. Pemesanan Pembelian', 'readonly']) }}
        @if($errors->has('po_transaksi'))
            <span class="help-block">
                <strong>{{ $errors->first('po_transaksi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
    {{ Form::label('tanggal_pesan', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::date('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...']) }}
        @if($errors->has('tanggal_masuk'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_masuk') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('suplier_id') ? ' has-error' : '' }}">
    {{ Form::label('supplier', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::select('suplier_id', $suplier, null, ['id' => 'id', 'class' => 'form-control selectpicker', 'placeholder' => 'Pilih Supplier...', 'data-live-search' => 'true']) }}
        @if($errors->has('suplier_id'))
            <span class="help-block">
                <strong>{{ $errors->first('suplier_id') }}</strong>
            </span>
        @endif
    </div>
</div>

@include('template.button-form')
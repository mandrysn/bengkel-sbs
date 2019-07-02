<div class="form-group{{ $errors->has('bbm_transaksi') ? ' has-error' : '' }}">
    {{ Form::label('no_barang_masuk', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::text('bbm_transaksi', $kode, ['class' => 'form-control', 'placeholder' => 'No. Bukti Barang Masuk', 'readonly']) }}
        @if($errors->has('bbm_transaksi'))
            <span class="help-block">
                <strong>{{ $errors->first('bbm_transaksi') }}</strong>
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

<div class="form-group{{ $errors->has('po_transaksi_id') ? ' has-error' : '' }}">
    {{ Form::label('cari_barang', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        <select name="po_transaksi_id" class="form-control selectpicker" data-live-search="true" placeholder="Pilih Barang...">
            <option disabled selected>Pilih Pemesanan...</option>
            @foreach ( $notransaksi as $key )
                <option value="{{ $key->id }}">{{ $key->po_transaksi }} - {{ $key->suplier->nama_suplier }}</option>
            @endforeach
        </select>
        @if($errors->has('po_transaksi_id'))
            <span class="help-block">
                <strong>{{ $errors->first('po_transaksi_id') }}</strong>
            </span>
        @endif
    </div>
</div>
@include('template.button-form')
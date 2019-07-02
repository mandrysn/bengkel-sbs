@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            {!! Form::model($data,
               ['method' => 'PATCH',
                'action' => [$controller.'@update', $data->id],
                'files' => 'true',
                'class' => 'form-horizontal']) !!}
                
<div class="form-group">
                    {{ Form::label('No. Invoice', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('kode_tagihan', null, ['class' => 'form-control', 'placeholder' => 'Kode Barang', 'readonly']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('No. Claim', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('no_claim', $data->sotransaksi->sokendaraan->sopelanggan->no_claim, ['class' => 'form-control', 'placeholder' => 'Kode Barang', 'readonly']) }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('tanggal_masuk') ? ' has-error' : '' }}">
                    {{ Form::label('tanggal_masuk', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::text('tanggal_masuk', null, ['class' => 'form-control', 'placeholder' => 'Pilih tanggal masuk...', 'readonly']) }}
                    </div>
                </div>


                <div class="form-group">
                    {{ Form::label('diskon', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        {{ Form::number('diskon',  null, ['class' => 'form-control', 'placeholder' => 'Diskon', 'min' => '0']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('pajak', null, ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-3">
                        <div class="input-group">
                            {{ Form::number('pajak',  null, ['class' => 'form-control', 'placeholder' => 'Pajak %', 'min' => '0', 'max' => '100']) }}
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                
                @include('template.button-form')
                
                {!! Form::close() !!}
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Deskripsi</th>
                            <th>Amount (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jasa</td>
                            <td>{{ number_format($totalj) }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sparepart</td>
                            <td>{{ number_format($totalb) }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Material</td>
                            <td>{{ number_format($totalm) }}</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&#8212; PPn (%)</th>
                            <th>{{ $data->sotransaksi->ppn == null ? "0" : $data->sotransaksi->ppn }} %</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&#8212; Sub Total</th>
                            <th>{{ number_format( $jumlah = ($totalj + $totalb + $totalm) + ( ($data->sotransaksi->ppn / 100) * ($totalj + $totalb + $totalm) ) ) }}</th>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pajak</td>
                            <td>{{ number_format($data->pajak) }} %</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Diskon</td>
                            <td>{{ number_format($data->diskon) }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <th><font size="3">&#8212; Total</font></th>
                            <th><font size="3">{{ number_format( ($jumlah) + ( ($jumlah) * ($data->pajak / 100) ) - $data->diskon ) }}</font></th>
                        </tr>


                    </tbody>
                </table>
@stop
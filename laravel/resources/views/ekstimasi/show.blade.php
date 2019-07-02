@extends('template.template')

@section('content')
<style type="text/css">
	#gambar{
		max-width: 100%;
	}
	@media screen and (max-width: 1199px) {
	  #gambar {
	   	float: none;
		margin-top: 5px;
		margin-bottom: 5px;
	  }
	}

</style>
            <h1 class="page-header">
                <img src="{{ asset('admin/images/inventory.png') }}" style="height:50px; width:90px; margin-top:-15px; margin-bottom:-10px;" title="logo sbs" alt="logo sbs">
                <span margin>Pre Invoice {{ $title }}</span>
            </h1>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $sot->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $sot->asuransi_id == '0' ? $sot->sokendaraan->sopelanggan->asuransi->nama_asuransi : $sot->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->no_claim }}</td></tr>
                    <tr><th>Tanggal</th><td>:</td><td>{{ $sot->tanggal_so }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Kendaraan</h2>

                <table class="table">
                    <tr><th width="30%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $sot->sokendaraan->no_polisi }} / {{ $sot->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sokendaraan->no_mesin }} / {{ $sot->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $sot->sokendaraan->merek->nama_merek }} / {{ $sot->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->warna_kendaraan }}</td></tr>
                    <tr><th>&nbsp;</th><td></td><td>&nbsp;</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Keluhan</h2>
	            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keluhan</th>
                            <th>Perbaikan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($details as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->keluhan }}</td>
                            <td>{{ $data->perbaikan }}</td>
                            <td>{{ $data->keterangan }}</td>
                            
                        </tr>
                        
                        @endforeach

                </table>
                <p></p>
							{!! Form::open(
                                ['route' => ['print-pre-invoice.store'], 
                                    'role'  => 'form',
                                    'method'=> 'post',
                                    'class' => 'form-inline']) !!}
                                     
                                {{ Form::hidden('route', 'pre-invoice') }}
								{{ Form::hidden('id', $sot->id) }}
                                {!! Form::submit('Cetak', ['class' => 'btn btn btn-info ']) !!}
								<a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                            {!! Form::close() !!}
							
            </div>

            <div class="col-md-6">
                    <h2>Data Permintaan</h2>
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pekerjaan / Item</th>
                                    <th>Qty</th>
                                    <th>Biaya per Transaksi (Rp)</th>
                                    <th>Diskon (%)</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($count_jasa > 0)
                                <tr>
                                    <td colspan="7">Detail Jasa</td>
                                </tr>
                                @endif
        
                                @php ($tagihan_jasa = 0)
                                @php ($total = 0)
                                @foreach($detail_jasa as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->kegiatan }}</td>
                                    <td width="8%">{{ $data->quantity }} Kali</td>
                                    <td>{{ number_format($data->harga_transaksi) }}</td>
                                    <td width="10%">{{ $data->diskon }} %</td>
                                    <td align="right">{{ number_format( $tagihan_jasa = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan_jasa) }}</td>
                                </tr>
                                @endforeach
								
								@if($count_jasa > 0)
								<tr>
									<td colspan="5" align="right" valign="middle"><h5>total jasa (Rp)</h5></td>
									<td valign="middle"><h5>{{ number_format($total) }}</h5></td>
								</tr>
								@endif
    
                                @if($count_barang > 0)
                                <tr>
                                    <td colspan="7">Detail Barang</td>
                                </tr>
                                @endif
        
                                @php ($tagihan_barang = 0)
                                @php ($total_barang = 0)
                                @foreach($detail_barang as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->barang->nama_barang }}</td>
                                    <td width="8%">{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                    <td>{{ number_format($data->harga_transaksi) }}</td>
                                    <td width="10%">{{ $data->diskon }} %</td>
                                    <td align="right">{{ number_format( $tagihan_barang = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_barang += $tagihan_barang) }}</td>
                                </tr>
                                @endforeach
								@if($count_barang > 0)
								<tr>
									<td colspan="5" align="right" valign="middle"><h5>total barang (Rp)</h5></td>
									<td valign="middle"><h5>{{ number_format($total_barang) }}</h5></td>
								</tr>
								@endif
    
                                @if($count_material > 0)
                                <tr>
                                    <td colspan="7">Detail Material</td>
                                </tr>
                                @endif
        
                                @php ($tagihan_material = 0)
                                @php ($total_material = 0)
                                @foreach($detail_material as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->barang->nama_barang }}</td>
                                    <td width="8%">{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                    <td>{{ number_format($data->harga_transaksi) }}</td>
                                    <td width="10%">{{ $data->diskon }} %</td>
                                    <td align="right">{{ number_format( $tagihan_material = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_material += $tagihan_material) }}</td>
                                </tr>
                                @endforeach
								@if($count_material > 0)
								<tr>
									<td colspan="5" align="right" valign="middle"><h5>total material (Rp)</h5></td>
									<td valign="middle"><h5>{{ number_format($total_material) }}</h5></td>
								</tr>
								@endif
        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" align="right" valign="middle"><h5>total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format($total_barang + $total + $total_material) }}</h5></td>
                                </tr>
								<tr>
                                    <td colspan="5" align="right" valign="middle"><h5>PPN (%)</h5></td>
                                    <td valign="middle"><h5>{{ $sot->ppn == null ? "0" : $sot->ppn }} %</h5></td>
                                </tr>
								<tr>
                                    <td colspan="5" align="right" valign="middle"><h5>grand total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format( ($total_barang + $total + $total_material) + ( ($sot->ppn / 100) * ($total_barang + $total + $total_material) ) ) }}</h5></td>
                                </tr>
                            </tfoot>
                        </table>
        
                </div>

            
@stop
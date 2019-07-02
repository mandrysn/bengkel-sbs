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
            <h1 class="page-header">{{ $title }}</h1>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $sot->sotransaksi->asuransi_id == '0' ? $sot->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $sot->sotransaksi->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->sopelanggan->no_claim }}</td></tr>
                    <tr><th>Status Tagihan</th><td>:</td><td>{{ $sot->status_tagihan == 1 ? "Belum terbayar" : "Terbayar" }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Kendaraan</h2>

                <table class="table">
                    <tr><th width="30%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $sot->sotransaksi->sokendaraan->no_polisi }} / {{ $sot->sotransaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->no_mesin }} / {{ $sot->sotransaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $sot->sotransaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $sot->sotransaksi->sokendaraan->warna_kendaraan }}</td></tr>
                    <tr><th>Status Pekerjaan</th><td>:</td><td>{{ $sot->status_pekerjaan == 1 ? "Outstanding" : "Selesai" }}</td></tr>
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

                    <h2>Data Pekerjaan</h2>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Item/Pekerjaan</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Jumlah</th>
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
                                <td>{{ $data->kegiatan }}</td>
                                <td>{{ $data->quantity }} Kali</td>
                                <td align="right">{{ number_format($data->harga_transaksi) }}</td>
                                <td width="10%">{{ $data->diskon }} %</td>
                                <td align="right">{{ number_format( $tagihan_jasa = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan_jasa) }}</td>
                            </tr>
                            
                            @endforeach

                            @if($count_barang > 0)
                            <tr>
                                <td colspan="7">Detail Barang</td>
                            </tr>
                            @endif
    
                            @php ($tagihan_barang = 0)
                            @php ($total_barang = 0)
                            @foreach($detail_barang as $index => $data)
                            <tr>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                <td align="right">{{ number_format($data->harga_transaksi) }}</td>
                                <td width="10%">{{ $data->diskon }} %</td>
                                <td align="right">{{ number_format( $tagihan_barang = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_barang += $tagihan_barang) }}</td>
                            </tr>
                            
                            @endforeach

                            @if($count_material > 0)
                            <tr>
                                <td colspan="7">Detail Material</td>
                            </tr>
                            @endif
    
                            @php ($tagihan_material = 0)
                            @php ($total_material = 0)
                            @foreach($detail_material as $index => $data)
                            <tr>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                <td align="right">{{ number_format($data->harga_transaksi) }}</td>
                                <td width="10%">{{ $data->diskon }} %</td>
                                <td align="right">{{ number_format( $tagihan_material = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_material += $tagihan_material) }}</td>
                            </tr>
                            @endforeach
    
                        </tbody>
                        <tfoot>
                                <tr>
                                    <td colspan="4" align="right" valign="middle"><h5>total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format($total_barang + $total + $total_material) }}</h5></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="right" valign="middle"><h5>PPN (%)</h5></td>
                                    <td valign="middle"><h5>{{ $sot->sotransaksi->ppn == null ? "0" : $sot->sotransaksi->ppn }} %</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" valign="middle"><h5>Sub Total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format( $jumlah = ($total_barang + $total + $total_material) + ( ($sot->sotransaksi->ppn / 100) * ($total_barang + $total + $total_material) ) ) }}</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" valign="middle"><h5>Pajak (%)</h5></td>
                                    <td valign="middle"><h5>{{ $sot->pajak == null ? "0" : $sot->pajak }} %</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" valign="middle"><h5>Diskon (Rp)</h5></td>
                                    <td valign="right"><h5>{{ $sot->diskon == null ? "0" : $sot->diskon }} Rp</h5></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="right" valign="middle"><h5>grand total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format( ($jumlah) + ( ($jumlah) * ($sot->pajak / 100) ) - $sot->diskon ) }}</h5></td>
                                </tr>
                            </tfoot>
                    </table>
                </div>

            <div class="col-md-6">
                    
                    
                    @if ( $jfp > 0 )
                    <h4>Foto Proses</h4>
                    <table class="table table-bordered table-hover">
                        <tbody>
                            @foreach ( explode('|', $foto_proses) as $fp )
                            <tr class="left">
                                <td>{!! Html::image(asset('asset/order/proses/'.$fp), null, ['class'=> 'img-rounded img-responsive' , 'id' => 'gambar', 'width' => '30%']) !!}</td>
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
        
                </div>
    
                <div class="col-md-6">
                    <h4>Sebelum</h4>
                    <table class="table table-bordered table-hover">
                        <tfoot>
                            <tr>
                                <th>{!! Html::image(asset('asset/order/depan/'.$sot->sotransaksi->sokendaraan->foto_depan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar', 'width' => '70%']) !!}</th>
                            </tr>
                        </tfoot>
                    </table>
    
                    @if (is_null($aft) )
                    <h4>Belum ada gambar terbaru</h4>
                    @else
                    <h4>Sesudah</h4>
                    
                    <table class="table table-bordered table-hover">
                        <tfoot>
                            <tr>
                                <th>{!! Html::image(asset('asset/order/depan/'.$aft->foto_depan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar', 'width' => '70%']) !!}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @endif

                    
                    <p></p>
                    <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a> 
                </div>
            
@stop

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin inventory by: GreenNusa developer Alg.field">
        <meta name="author" content="Westilian, Alg">

        <title>Aplikasi Inventory</title>

        <!-- CSS 16-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/bootstrap/theme/16/bootstrap.min.print.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/selectbox/css/bootstrap-select.min.css') }}">
        
        <!-- #Eror 9, 12-->
        <style type="text/css">
            html {
                position: relative;
                min-height: 100%;
            }
            body {
                margin-bottom: 60px;
                padding-top: 20px;
            }

            body > .container {
                padding: 60px 15px 0;
            }
            .container .text-muted {
                margin: 15px 0;
            }

            code {
                font-size: 80%;
            }
        </style>
    </head>
    <body>
       

	    <div class="container-fluid">

                <h4 class="page-header">
                        <img src="{{ asset('admin/images/inventory.png') }}" style="height:40px; width:60px; margin-top:-5px; margin-bottom:-17px;" title="logo sbs" alt="logo sbs">
                        <span>{{ $title }}</span>
                    </h4>

            <div class="col-md-6" style="float:left; font-size: 10px !important;">
            
                    <h3>Data Pelanggan</h3>

                    <table class="table" width="50%">
                        <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td width="50%">{{ $sot->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                        <tr><th>Alamat</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                        <tr><th>No. Telpon</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                        <tr><th>Asuransi</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td></tr>
                        <tr><th>No. Claim</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->no_claim }}</td></tr>
                    </table>

            </div>

            <div class="col-md-6" style="float:right; font-size: 10px !important;">

                    <h3>Data Kendaraan</h3>

                    <table class="table">
                        <tr><th width="30%">No. Polisi / Tahun</th><td width="1%">:</td><td width="50%">{{ $sot->sokendaraan->no_polisi }} / {{ $sot->sokendaraan->tahun_kendaraan }}</td></tr>
                        <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sokendaraan->no_mesin }} / {{ $sot->sokendaraan->no_rangka }}</td></tr>
                        <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $sot->sokendaraan->merek->nama_merek }} / {{ $sot->sokendaraan->merek->unit_merek }}</td></tr>
                        <tr><th>KM Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->km_kendaraan }}</td></tr>
                        <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->warna_kendaraan }}</td></tr>
                    </table>

            </div>

                <div class="col-md-6"  style="margin-top: 140px; font-size: 10px !important;">
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
                                    <td>{{ $data->quantity }} Kali</td>
                                    <td>{{ number_format($data->harga_transaksi) }}</td>
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
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->barang->nama_barang }}</td>
                                    <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                    <td>{{ number_format($data->harga_transaksi) }}</td>
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
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->barang->nama_barang }}</td>
                                    <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                    <td>{{ number_format($data->harga_transaksi) }}</td>
                                    <td width="10%">{{ $data->diskon }} %</td>
                                    <td align="right">{{ number_format( $tagihan_material = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_material += $tagihan_material) }}</td>
                                </tr>
                                @endforeach
        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" align="right" valign="middle"><h5>total (Rp)</h5></td>
                                    <td valign="middle"><h5>{{ number_format($total_barang + $total + $total_material) }}</h5></td>
                                </tr><tr>
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

            
    	</div>
	    
    </body>
</html>
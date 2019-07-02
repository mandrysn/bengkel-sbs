<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin inventory by: GreenNusa developer Alg.field">
        <meta name="author" content="Westilian, Alg">

        <title>Aplikasi Inventory</title>
        <style type="text/css">
            table {
                font: 9px/20px Verdana, Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                }
            
            th {
                padding: 0 0.5em;
                }
            .center {
                text-align: center;
            }
            .left {
                text-align: left;
            }
            th.border {
                border-right: 1px solid #CCC;
                border-left: 1px solid #CCC;
                border-bottom: 1px solid #CCC;
                border-top: 1px solid #CCC;
                }
            
            tr.yellow td {
                border-top: 1px solid #FB7A31;
                border-bottom: 1px solid #FB7A31;
                }
            td.border {
                border-right: 1px solid #CCC;
                border-left: 1px solid #CCC;
                border-bottom: 1px solid #CCC;
                border-top: 1px solid #CCC;
                padding: 0 0.5em;
                }
            
            td.width {
                width: 130px;
                }
            
            td.date {
                width: 64px;
                }
            
            td.no {
                width: 94px;
                }
            
            td.mobil {
                width: 100px;
                }
            
            td.nomor {
                width: 7px;
                }
            
            td.asuransi {
                width: 110px;
                }
            
            td.adjacent {
                border-left: 1px solid #CCC;
                text-align: center;
                }
            
            td.adleft {
                border-right: 1px solid #CCC;
                text-align: center;
                }
            span {
                font: 16px/20px Verdana, Arial, Helvetica, sans-serif;
            }
            .page-header {
                padding-bottom:3.5px;
                margin:10px 0 11px;
                border-bottom:1px solid #dddddd
            }
            h4, .h4, h5, .h5, h6, .h6 {
                margin-top:10.5px;
                margin-bottom:10.5px
            }
            h2,.h2 { font-size:32px }
            h4, .h4 { font-size:19px }
            p,h2,h3{orphans:3;widows:3}h2,h3{page-break-after:avoid}
            h1,h2,h3,h4,h5,h6{font-family:"Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;font-weight:300;color:inherit}
        </style>
    </head>
    <body>

            <h4 class="page-header">
                <span style="float: left">
                    <img src="admin/images/inventory.png" style="width:130px; margin-left:-15px; margin-top:-20px; margin-bottom:-17px;" title="logo sbs" alt="logo sbs">
                    <div style="margin-top:-20px; margin-left: 110px; font-size: 16px;">
                        <strong>Body Repair Oven System</strong>
                    </div>
                </span>
                <span style="float: right; margin-top:-30px; font-size: 13px;line-height:1.1;">
                    <strong>PT. SINAR BORNEO SAMARINDA</strong><br>
                    JL. KH. Wahid Hasyim Gg. Salam No. 99A<br>
                    Samarinda-Kalimantan Timur<br>
                    Telp : 0541-4115027 / 0822 1306 9998<br>
                    Email : sbs.bodyshop@gmail.com<br>
                    Cabang Bontang : Jl. Poros Bontang - Samarinda KM.5
                </span>
                
                <div style="clear: both;"></div>
            </h4>

            <div style="float:left; font-size: 10px !important;">
            
                    <span><b>Data Pelanggan</b></span>

                    <table width="50%">
                        <tr><th width="20%" class="left">Nama Pelanggan</th><td width="1%">:</td><td width="50%">{{ $sot->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                        <tr><th class="left">Alamat</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                        <tr><th class="left">No. Telpon</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                        <tr><th class="left">Asuransi</th><td>:</td><td>{{ $sot->asuransi_id == '0' ? $sot->sokendaraan->sopelanggan->asuransi->nama_asuransi : $sot->asuransi->nama_asuransi }}</td></tr>
                        <tr><th class="left">No. Claim</th><td>:</td><td>{{ $sot->sokendaraan->sopelanggan->no_claim }}</td></tr>
                        <tr><th class="left">Tanggal</th><td>:</td><td>{{ $sot->tanggal_so }}</td></tr>
                    </table>

            </div>

            <div style="float:right; font-size: 10px !important;">

                    <span><b>Data Kendaraan</b></span>

                    <table>
                        <tr><th class="left" width="30%">No. Polisi / Tahun</th><td width="1%">:</td><td width="50%">{{ $sot->sokendaraan->no_polisi }} / {{ $sot->sokendaraan->tahun_kendaraan }}</td></tr>
                        <tr><th class="left">No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sokendaraan->no_mesin }} / {{ $sot->sokendaraan->no_rangka }}</td></tr>
                        <tr><th class="left">Merek / Type Unit</th><td>:</td><td>{{ $sot->sokendaraan->merek->nama_merek }} / {{ $sot->sokendaraan->merek->unit_merek }}</td></tr>
                        <tr><th class="left">KM Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->km_kendaraan }}</td></tr>
                        <tr><th class="left">Warna Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->warna_kendaraan }}</td></tr>
                        <tr><th>&nbsp;</th><td></td><td>&nbsp;</td></tr>
                    </table>

            </div>

            <div style="clear:both"></div>

                <div  style="margin-top: 155px; font-size: 10px !important;">
                    <h2><strong>Data Permintaan</strong></h2>
                    <table width="100%">
                            <thead>
                                <tr>
                                    <th class="border center" width="5%">No</th>
                                    <th class="border center" width="43%">Pekerjaan / Item</th>
                                    <th class="border center" width="7%">Qty</th>
                                    <th class="border center" width="15%">Harga (Rp)</th>
                                    <th class="border center" width="10%">Diskon (%)</th>
                                    <th class="border center" width="15%">Jumlah (Rp)</th>
                                    <th class="border center" width="15%">Keterangan</th>
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
                                    <td class="border" width="5%">{{ $index + 1 }}</td>
                                    <td class="border" width="43%">{{ $data->kegiatan }}</td>
                                    <td class="border" width="7%">{{ $data->quantity }} Kali</td>
                                    <td class="border" width="15%" align="right">{{ number_format($data->harga_transaksi) }}</td>
                                    <td class="border" width="10%">{{ $data->diskon }}</td>
                                    <td class="border" width="15%" align="right">{{ number_format( $tagihan_jasa = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td class="border" width="15%">{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan_jasa) }}</td>
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
                                    <td class="border" width="5%">{{ $index + 1 }}</td>
                                    <td class="border" width="43%">{{ $data->barang->nama_barang }}</td>
                                    <td class="border" width="7%">{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                    <td class="border" width="15%" align="right">{{ number_format($data->harga_transaksi) }}</td>
                                    <td class="border" width="10%">{{ $data->diskon }}</td>
                                    <td class="border" width="15%" align="right">{{ number_format( $tagihan_barang = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td class="border" width="15%">{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_barang += $tagihan_barang) }}</td>
                                </tr>
                                
                                @endforeach
    
                                @if($count_material > 0)
                                <tr>
                                    <td colspan="7">Detail Material</td>
                                </tr>
                                @endif
        
                                @php ($tagihan_material = 0)
                                @php ($total_material = 0)
                                @foreach ($detail_material as $index => $data)
                                <tr>
                                    <td class="border" width="5%">{{ $index + 1 }}</td>
                                    <td class="border" width="43%">{{ $data->barang->nama_barang }}</td>
                                    <td class="border" width="7%">{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                    <td class="border" width="15%" align="right">{{ number_format($data->harga_transaksi) }}</td>
                                    <td class="border" width="10%">{{ $data->diskon }}</td>
                                    <td class="border" width="15%" align="right">{{ number_format( $tagihan_material = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity ) }}</td>
                                    <td class="border" width="15%">{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total_material += $tagihan_material) }}</td>
                                </tr>
                                @endforeach
        
                                <tr>
                                    <td class="border" colspan="5" align="right" valign="middle"><h5>total (Rp)</h5></td>
                                    <td class="border" valign="middle" align="right">{{ number_format($total_barang + $total + $total_material) }}</td>
									<td>&nbsp;</td>
                                </tr>
								<tr>
                                    <td class="border" colspan="5" align="right" valign="middle"><h5>PPN (%)</h5></td>
                                    <td class="border" valign="middle" align="right">{{ $sot->ppn == null ? "0" : $sot->ppn }} %</td>
									<td>&nbsp;</td>
                                </tr>
								<tr>
                                    <td class="border" colspan="5" align="right" valign="middle"><h5>grand total (Rp)</h5></td>
                                    <td class="border" valign="middle" align="right">{{ number_format( ($total_barang + $total + $total_material) + ( ($sot->ppn / 100) * ($total_barang + $total + $total_material) ) ) }}</td>
									<td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                
            </div>

            
	    
    </body>
</html>
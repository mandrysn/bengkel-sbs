
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
            
            {{--<span style="margin-left:5px">{{ $transaksi->tanggal_pre }}</span>
			<span style="margin-left:20px">No. Unit Lapor {{ $transaksi->no_transaksi }}</span><br>--}}

            <table width="50%">
			<tr><th class="left">No. Unit Lapor</th><td>:</td><td>{{ $transaksi->no_transaksi }}</td></tr>
                    <tr><th width="27%" class="left">Nama Pelanggan</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th class="left">Alamat</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th class="left">No. Telpon</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th class="left">Asuransi</th><td>:</td><td>{{ $transaksi->asuransi_id == '0' ? $transaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $transaksi->asuransi->nama_asuransi }}</td></tr>
                    <tr><th class="left">No. Claim</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->no_claim }}</td></tr>
                </table>

            </div>

            <div style="float:right; font-size: 10px !important;">
                    <span>&nbsp;</span><br>
                <table width="47%">
				<tr><th class="left">Tanggal</th><td>:</td><td>{{ $transaksi->tanggal_pre }}</td></tr>
                    <tr><th class="left" width="32%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->no_polisi }} / {{ $transaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th class="left">No. Mesin / Rangka</th><td>:</td><td>{{ $transaksi->sokendaraan->no_mesin }} / {{ $transaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th class="left">Merek / Type Unit</th><td>:</td><td>{{ $transaksi->sokendaraan->merek->nama_merek }} / {{ $transaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th class="left">KM Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th class="left">Warna Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->warna_kendaraan }}</td></tr>
                </table>

            </div>

            <div style="clear:both"></div>

                <div  style="margin-top: 155px; font-size: 10px !important;">
                    <table width="100%">
                    <thead>
                        <tr>
                            <th class="border center">No</th>
                            <th class="border center">Keluhan</th>
                            <th  class="border center">Perbaikan</th>
                            <th  class="border center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                                                
                        @foreach($details as $index => $data)
                        
                        <tr>
                            <td  class="border">{{ $index + 1 }}</td>
                            <td  class="border">{{ $data->keluhan }}</td>
                            <td  class="border">{{ $data->perbaikan }}</td>
                            <td  class="border">{{ $data->keterangan }}</td>
                            
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

                <p></p>
                
            </div>

            
	    
    </body>
</html>
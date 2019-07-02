
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
                font: 11px/20px Verdana, Arial, Helvetica, sans-serif;
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
            .line1 { line-height: 1.6em }
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
          

            <div class="col-md-5" style="float:left">

                <table class="table line1">
                    <tr><th>No. SPK</th><td>:</td><td>{{ $transaksi->no_transaksi }}</td></tr>
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td width="20%">{{ $transaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->no_polisi }} / {{ $transaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $transaksi->asuransi_id == '0' ? $transaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $transaksi->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->warna_kendaraan }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $transaksi->sokendaraan->merek->nama_merek }} / {{ $transaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $transaksi->sokendaraan->no_mesin }} / {{ $transaksi->sokendaraan->no_rangka }}</td></tr>
					<tr><th>Tanggal Masuk</th><td>:</td><td>{{ $transaksi->tanggal_so }}</td></tr>
					<tr><th>Tanggal Keluar</th><td>:</td><td>{{ $transaksi->tanggal_claim }}</td></tr>
                </table>

            </div>

            <div style="float:right; margin-right: -50px;">

                <table width="50%">
                    <tr>
                        <th width="20%">&nbsp;</th>
                        <th width="20%"><center>Mengetahui</center></th>
                        <th width="20%">&nbsp;</th>
                    </tr>
                            
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr>
                            <td><center>.....................</center></td>
                            <td><center>....................</center></td>
                            <td><center>....................</center></td>
                    </tr>
                    
                </table>

            </div>

            <div style="margin-top: 184px">
                <table class="table-bordered line1" width="100%">
                    <thead>
                        <tr>
                            <th class="border center" width="3%">No</th>
                            <th class="border center">Keluhan</th>
                            <th class="border center">Perbaikan</th>
                            <th class="border center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                                                
                        @foreach($details as $index => $data)
                        
                        <tr>
                            <td class="border"><center>{{ $index + 1 }}</center></td>
                            <td class="border">{{ $data->keluhan }}</td>
                            <td class="border">{{ $data->perbaikan }}</td>
                            <td class="border">{{ $data->keterangan }}</td>
                            
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

                <p></p>
                
            </div>
			

            <div class="col-md-6" style="margin-top: -30px;">
					<h4><center>MOHON FOTO EPOXY</center></h4>
                    <h5>Pergantian Part</h5>

                    <table class="table" style="line-height: 1.1em;">
					@foreach($gantis as $index => $data)
                        <tr><th>{{ $index + 1 }}.</th><td>{{ $data->keterangan_ganti }}, <strong>{{ is_null($data->montir) ? '-' : $data->montir }}</strong>, {{ is_null($data->layanan) ? '-' : $data->jenis_layanan }}</td></tr>
					@endforeach
                    </table>
    
                </div>

            
    </body>
</html>
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

                    <div>
                    
                        <span style="font-size: 16px;"><strong>Purchase Order</strong></span>

                        <table class="table">
                            <tr><th width="30%">Nomor Pemesanan</th><td width="1%">:</td><td>{{ $transaksi->po_transaksi }}</td></tr>
                            <tr><th>Tanggal Pemesanan</th><td>:</td><td>{{ $transaksi->tanggal_masuk }}</td></tr>
                            <tr><th>Supplier</th><td>:</td><td><span style="font-size: 14px;"><strong>{{ $transaksi->suplier->nama_suplier }}</strong></span></td></tr>
							<tr><th>&nbsp;</th><td>&nbsp;</td><td>{{ $transaksi->suplier->alamat_suplier }}</td></tr>
                        </table>

                    </div>

            <div style="margin-top: -18px">

                <h6><strong>Purchase Order</strong></h6>

                <table width="100%">
                            <tr>
                                <th  class="border center" width="3%">No</th>
                                <th class="border center" width="11%">Nomor Polisi</th>
                                <th class="border center" width="19%">Nama Pemesan</th>
									<th class="border center" width="20%">Nomor Rangka</th>
									<th class="border center" width="19%">Nomor Mesin</th>
									<th class="border center" width="17%">Merek / Tipe</th>
                            </tr>
                            
                            @foreach($details as $index => $data)
                            
                            <tr>
                                <td class="border" >{{ $index + 1 }}</td>
                                <td class="border" >{{ $data->sotransaksibarang->sotransaksi->sokendaraan->no_polisi }}</td>
                                <td class="border" >{{ $data->sotransaksibarang->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
									<td class="border" >{{ $data->sotransaksibarang->sotransaksi->sokendaraan->no_rangka }}</td>
									<td class="border" >{{ $data->sotransaksibarang->sotransaksi->sokendaraan->no_mesin }}</td>
									<td class="border" >{{ $data->sotransaksibarang->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksibarang->sotransaksi->sokendaraan->merek->unit_merek }}</td>
                                
                            </tr>
                            
                            @endforeach
    
                    </table>

        </div>
        <br>
        <table width="100%">
            <thead>
                <tr>
                    <th class="border center" width="3%"><center>No</center></th>
                    <th class="border center" width="19%"><center>Nama Barang</center></th>
                    <th class="border center" width="4%"><center>Qty</center></th>
                    <th class="border center" width="14%"><center>Keterangan</center></th>
                </tr>
                </thead>
                <tbody>
                    @php ( $tagihan = 0 )
                    @php ( $total = 0 )
                    @foreach($details as $index => $data)
                    
                    <tr>
                        <td class="border"><center>{{ $index + 1 }}</center></td>
                        <td class="border">{{ $data->barang->nama_barang }}</td>
                        <td class="border"><center>{{ $data->po_quantity }} {{ $data->barang->satuan->kode_satuan }}</center></td>
                        <td class="border">{{ $data->keterangan_transaksi }}</center></td>
                    </tr>
                    
                    @endforeach
                </tbody>
                

            </table>
            <span style="font-size: 11px;">Demikian surat ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.<br>Hormat kami,</span>

    </body>
</html>

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

          <div class="col-md-6">
            <h4>Data Pemesanan</h4>

                <table class="table" width="50%">
                    <tr><th class="left" width="40%">Nomor Pemesanan Barang Masuk</th><td width="1%">:</td><td>{{ $sot->bbm_material }}</td></tr>
                    <tr><th class="left">Nomor Po Transaksi</th><td>:</td><td>{{ $sot->material->ma_transaksi }}</td></tr>
                    <tr><th class="left">Tanggal Pemesanan Datang</th><td>:</td><td>{{ $sot->tanggal_masuk }}</td></tr>
                </table>
        </div>

        <div class="col-md-6">
            <h4>Data Permintaan Barang Masuk</h4>
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="border center">No.</th>
                                    <th class="border center">Barang</th>
                                    <th class="border center">No. Part Barang</th>
                                    <th class="border center">Supplier</th>
                                    <th class="border center">Qty</th>
                                    <th class="border center">Harga (Rp)</th>
                                    <th class="border center">Keterangan</th>
                                    <th class="border center">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php ($tagihan = 0)
                                    @php ($total = 0)
                                @foreach($dbm as $index => $data)
                                <tr>
                                        <td class="border">{{ $index + 1 }}</td>
                                        <td class="border">{{ $data->barang->nama_barang }}</td>
                                        <td class="border">{{ $data->barang->no_part_barang }}</td>
                                        <td class="border">{{ $data->suplier->nama_suplier }}</td>
                                        <td class="border">{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                        <td class="border">{{ number_format($data->harga_transaksi) }}</td>
                                        <td class="border">{{ $data->keterangan_transaksi }}</td>
                                        <td class="border">{{ number_format( $tagihan = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->quantity) }}{{ Form::hidden('total',  $total += $tagihan) }}</td>

                                </tr>
                                    
                                @endforeach
        
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="border" align="right" valign="middle">total (Rp)</td>
                                    <td class="border" valign="middle">{{ number_format($total) }}</td>
                                </tr>
                            </tfoot>
                        </table>

        </div>
	    
    </body>
</html>
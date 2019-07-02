<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tagihan Or</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
		body {
			font: 12px/20px Verdana, Arial, Helvetica, sans-serif;
		}
            table {
                font: 12px/20px Verdana, Arial, Helvetica, sans-serif;
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
            }
            h4, .h4, h5, .h5, h6, .h6 {
                margin-top:10.5px;
                margin-bottom:10.5px
            }
			h6 { font-size: 13px }
            h2,.h2 { font-size:32px }
            h4, .h4 { font-size:19px }
            p,h2,h3{orphans:3;widows:3}h2,h3{page-break-after:avoid}
            h1,h2,h3,h4,h5,h6{font-family:"Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;font-weight:300;color:inherit}
			ul { list-style-type: none }
			/*-- 2.15 Invoice --*/
.invoice-container {
  margin-top: -40px;
  background-color: #fff;
  padding: 0px 2px;
}
.invoice-info {
  list-style: none;
  padding: 0px;
  margin: 0px;
}
.invoice-info label {
  display: inline-block;
  width: 8em;
}
.invoice-address label {
  font-size: 8px;
  font-weight: 500;
}
.invoice-title label {
  font-size: 11px;
  font-weight: 500;
}
.invoice-cal td span {
  display: block;
  text-align: right;
}
.amount-due {
  font-size: 15px !important;
  padding: 7px 0;
}
.invoice-type {
  width: 100px;
}
.invoice-qty {
  width: 50px;
  text-align: center !important;
}
.invoice-amount,
.invoice-unit {
  text-align: right !important;
  width: 100px;
}
@media print {
  .invoice-page .page-content {
    margin-left: 0px !important;
  }
  .invoice-page .top-bar,
  .invoice-page .left-aside,
  .invoice-page .right-aside {
    display: none !important;
  }
}
#ttd {
    margin-top: 10px;
    width: 25%;
    text-align: center;
    float: left;
    clear: both;
}

#admin {
    float: right;
    width: 25%;
    text-align: center;
    clear: both;
}
        </style>
		<script>
            window.print();
        </script>
    </head>
    <body>
            <h4 class="page-header">
                    <span style="float: left">
                          <img src="{{ asset('admin/images/inventory.png') }}" style="width:190px; margin-left:-15px; margin-top:-5px; margin-bottom:-17px;" title="logo sbs" alt="logo sbs">
                          <div style="margin-top:-33px; margin-left: 160px; font-size: 17px;">
                            <strong>Body Repair Oven System</strong>
                            
                        </div>
                        </span>
                          <span style="float: right; font-size: 13px; line-height: 1.1em;"><strong>PT. SINAR BORNEO SAMARINDA</strong><br>
                                    JL. KH. Wahid Hasyim Gg. Salam No. 99A<br>
                                    Samarinda-Kalimantan Timur<br>
                                    Telp : 0541-4115027 / 0822 1306 9998<br>
                                    Email : sbs.bodyshop@gmail.com<br>
                                    Cabang Bontang : Jl. Poros Bontang - Samarinda KM.5</span>
                        
                      <div style="clear: both;"></div>
                      </h4>
	

    <section id="biodata">
        <div class="header">
            <h6><center><strong>TANDA TERIMA OR</strong></center></h6>
        </div>
		
            <div>
                <table>
                    <tr>
                        <th width="100">Kepada</th>
                        <td>: </td>
						<td width="450">{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
						<td>{{ $data->sotransaksi->asuransi_id == '0' ? 'Tidak ada data' : $data->sotransaksi->asuransi->nama_asuransi }}</td>
                    </tr>
                    <tr>
                        <th>Dari</th>
                        <td>: </td>
						<td>PT. SINAR BORNEO SAMARINDA</td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
						<td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: </td>
						<td>Pembayaran OR Unit {{ $data->sotransaksi->sokendaraan->merek->nama_merek }} {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}, {{ $data->sotransaksi->sokendaraan->no_polisi }}</td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
						<td>{{ $data->sotransaksi->sokendaraan->warna_kendaraan }}</td>
                    </tr>
                    <tr>
                        <th>Nominal</th>
                        <td>: </td>
						<td>Rp. {{ number_format($data->jumlah_or) }} ,-</td>
                    </tr>
                </table>
            </div>
			
    </section>

    <section id="ttd" style="font-size: 12px;">
	<br>
        Yang Menerima
        <br><br>
        <br><br>
        <br><br>
        PT. SINAR BORNEO SAMARINDA
    </section>

	<section id="admin" style="font-size: 12px;">
    Samarinda, {{ $data->tanggal_masuk }}<br>
        Yang Menyerahkan
        <br><br>
        <br><br>
        <br><br>
        {{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}
    </section>

    </body>
</html>
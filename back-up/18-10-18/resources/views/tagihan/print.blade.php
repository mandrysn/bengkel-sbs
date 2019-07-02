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
		body {
			font: 12px/20px Verdana, Arial, Helvetica, sans-serif;
		}
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
		
		<div class="row"  style="margin-top:-20px">
				<div class="invoice-title">
					<h3>INVOICE</h3>
				</div>
		</div>

		<div class="row" style="margin-top:-10px">
				<ul class="invoice-info">
					<li><label style="width: 20%">Tanggal</label>{{$data->tanggal_masuk }}</li>
					<li><label style="width: 20%">No Invoice</label>{{$data->kode_tagihan }}</li>
					<li><label style="width: 20%">PO Claim</label>{{ $data->sotransaksi->sokendaraan->sopelanggan->no_claim }}</li>
					<li><label style="width: 20%">Nama Tertanggung</label>{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</li>
					<li><label style="width: 20%">No Polisi</label>{{ $data->sotransaksi->sokendaraan->no_polisi }}</li>
					<li><label style="width: 20%">Jenis Kendaraan</label>{{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}</li>
				</ul>

			<div class="col-md-6">
				<h4>Kepada</h4>
				<address>
			<strong>{{ $data->sotransaksi->asuransi_id == '0' ? 'Tidak ada data' : $data->sotransaksi->asuransi->nama_asuransi }}</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table width="100%">
						<thead>
							<tr>
								<th class="border invoice-id">
									<center>Description</center>
								</th>
								<th class="border invoice-date">
									<center>Amount</center>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="border invoice-type">
									Jasa Perbaikan
								</td>
								<td class="border invoice-amount">
									{{ number_format($totalj) }}
								</td>
							</tr>
							<tr>
								<td class="border invoice-type">
									Spare Parts
								</td>
								<td class="border invoice-amount">
									{{ number_format($totalb) }}
								</td>
							</tr>
							<tr>
								<td class="border invoice-type">
									Material
								</td>
								<td class="border invoice-amount">
									{{ number_format($totalm) }}
								</td>
							</tr>
							<tr class="invoice-cal">
								<td class="border">
									<span>PPn (%)</span>
									<span>Sub Total</span>
									<span>Pajak (%)</span>
									<span>Diskon</span>
									<span class="amount-due">Total</span>
								</td>
								<td class="border">
									<span>{{ $data->sotransaksi->ppn == null ? "0" : $data->sotransaksi->ppn }}</span>
									<span>{{ number_format( $jumlah = ($totalj + $totalb + $totalm) + ( ($data->sotransaksi->ppn / 100) * ($totalj + $totalb + $totalm) ) ) }}</span>
									<span>{{ number_format($data->pajak) }}</span>
									<span>{{ number_format($data->diskon) }}</span>
									<span class="amount-due">{{ number_format( ($jumlah) + ( ($jumlah) * ($data->pajak / 100) ) - $data->diskon ) }}</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<h6>Notes:</h6>
				<p>
					*Pembayaran dapat dilakukan secara transfer melalui bank Mandiri 148-00-0235522-3 a/n PT. Sinar Borneo Samarinda.<br>
					*Pembayaran melalui Check/Giro diangap lunas setelah clearing
				</p>
				
			</div>
			<div class="col-md-6" style="float:right">
				Head Finance<br><br><br><br><br>
				_______________<br>
				Ahmad Hamzah
			</div>
			
			
		</div>
						<p align="justify" style="margin-top:150px;">Bila ada perbedaan dalam invoice dapat memberitahukan kepada kami dalam waktu 7 hari setelah menerima invoice<br>
						Silahkan hubungi sbs.bodyshop@gmail.com<br>
						Terima Kasih Atas Kerja Samanya!</p>



</body>

</html>
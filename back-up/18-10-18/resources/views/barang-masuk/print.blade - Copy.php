
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
                        <span style="float: left">
                              <img src="{{ asset('admin/images/inventory.png') }}" style="width:120px; margin-top:-20px;" title="logo sbs" alt="logo sbs">
                              <div style="margin-top: -30px; margin-left: 125px; font-size: 15px;"><strong>Body Repair Oven System</strong></div>
                            </span>
                              <span style="float: right; margin-top: -30px; font-size: 13px;"><strong>PT. SINAR BORNEO SAMARINDA</strong><br>
                                        JL. KH. Wahid Hasyim Gg. Salam No. 99A<br>
                                        Samarinda-Kalimantan Timur<br>
                                        Telp : 0541-4115027 / 0822 1306 9998<br>
                                        Email : sbs.bodyshop@gmail.com<br>
                                        Cabang Bontang : Jl. Poros Bontang - Samarinda KM.5</span>
                            
                          <div style="clear: both;"></div>
                          </h4>

          <div class="col-md-6">
            <h5>Data Pemesanan</h5>

            <table class="table" width="50%">
                <tr><th width="40%">Nomor Pemesanan Barang Masuk</th><td width="1%">:</td><td>{{ $sot->bbm_transaksi }}</td></tr>
                <tr><th>Nomor Po Transaksi</th><td>:</td><td>{{ $sot->potransaksi->po_transaksi }}</td></tr>
                <tr><th>Tanggal Pemesanan Datang</th><td>:</td><td>{{ $sot->tanggal_masuk }}</td></tr>
            </table>
        </div>

        <div class="col-md-6" style="margin-top: -15px;">
            <h5>Data Barang Masuk</h5>
            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th align="center">No</th>
                            <th align="center">Item</th>
                            <th align="center">Supplier</th>
                            <th align="center">Qty</th>
                            <th align="center">Biaya per Barang (Rp)</th>
                            <th align="center">Diskon (%)</th>
                            <th align="center">Jumlah (Rp)</th>
                            <th align="center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                            @php ($tagihan = 0)
                            @php ($total = 0)
                        @foreach($dbm as $index => $data)
                        <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>{{ $data->suplier->nama_suplier }}</td>
                                <td>{{ $data->bm_quantity }} /{{  $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                                <td align="right">{{ number_format($data->harga_transaksi) }}</td>
                                <td>{{ $data->diskon }} %</td>
                                <td align="right">{{ number_format( $tagihan = ( $data->harga_transaksi - ($data->harga_transaksi * $data->diskon / 100) ) * $data->bm_quantity) }}</td>
                                <td>{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan) }}</td>

                        </tr>
                            
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" align="right" valign="middle"><h5>total (Rp)</h5></td>
                            <td valign="middle"><h5>{{ number_format($total) }}</h5></td>
                        </tr>
                    </tfoot>
                </table>

        </div>


            
    	</div>
	    
    </body>
</html>
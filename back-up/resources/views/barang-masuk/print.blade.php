
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

          <div class="col-md-6">
            <h2>Data Pemesanan</h2>

            <table class="table" width="50%">
                <tr><th width="40%">Nomor Pemesanan Barang Masuk</th><td width="1%">:</td><td>{{ $sot->bbm_transaksi }}</td></tr>
                <tr><th>Nomor Po Transaksi</th><td>:</td><td>{{ $sot->potransaksi->po_transaksi }}</td></tr>
                <tr><th>Tanggal Pemesanan Datang</th><td>:</td><td>{{ $sot->tanggal_masuk }}</td></tr>
            </table>
        </div>

        <div class="col-md-6">
            <h2>Data Barang Masuk</h2>
            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Supplier</th>
                            <th>Qty</th>
                            <th>Biaya per Barang (Rp)</th>
                            <th>Diskon (%)</th>
                            <th>Jumlah (Rp)</th>
                            <th>Keterangan</th>
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
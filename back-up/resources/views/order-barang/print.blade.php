
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
            
                <h3>Data Pemesanan</h3>

                <table class="table">
                    <tr><th width="30%">Nomor Pemesanan</th><td width="1%">:</td><td>{{ $transaksi->po_transaksi }}</td></tr>
                    <tr><th>Tanggal Pemesanan</th><td>:</td><td>{{ $transaksi->tanggal_masuk }}</td></tr>
                    <tr><th>Supplier</th><td>:</td><td>{{ $transaksi->suplier->nama_suplier }}</td></tr>
                </table>

            </div>

            <div class="col-md-6" style="margin-top: -20px">

                <h3>Data Pemesan</h3>

                <table class="table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Nomor Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Nomor Polisi</th>
                                <th>Barang Dipesan</th>
                            </tr>
                            
                            @foreach($details as $index => $data)
                            
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $data->sotransaksibarang->sotransaksi->no_transaksi }}</td>
                                <td>{{ $data->sotransaksibarang->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                                <td>{{ $data->sotransaksibarang->sotransaksi->sokendaraan->no_polisi }}</td>
                                <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                                
                            </tr>
                            
                            @endforeach
    
                    </table>

        </div>
        <br>
        <table class="table-bordered" width="100%">
            <thead>
                <tr>
                    <th><center>No</center></th>
                        <th><center>Nama Barang / Kode</center></th>
                        <th><center>Kode Part</center></th>
                        <th><center>Qty</center></th>
                        <th><center>Harga (Rp)</center></th>
                        <th><center>Diskon</center></th>
                        <th><center>Total</center></th>
                        <th><center>Keterangan</center></th>
                    </tr>
                </thead>
                <tbody>
                    @php ( $tagihan = 0 )
                    @php ( $total = 0 )
                    @foreach($details as $index => $data)
                    
                    <tr>
                        <td><center>{{ $index + 1 }}</center></td>
                        <td>{{ $data->barang->nama_barang }} - {{ $data->barang->kode_barang }}</td>
                        <td><center>{{ $data->barang->no_part_barang }}</center></td>
                        <td width="15%"><center>{{ $data->po_quantity }} {{ $data->barang->satuan->kode_satuan }}</center></td>
                        <td><center>{{ number_format($data->barang->harga_beli) }}</center></td>
                        <td><center>{{ $data->diskon }} %</center></td>
                        <td><center>{{ number_format( $tagihan = ( $data->barang->harga_beli - ($data->barang->harga_beli * $data->diskon / 100) ) * $data->po_quantity ) }}</center></td>
                        <td width="15%">{{ $data->keterangan_transaksi }}{{ Form::hidden('total',  $total += $tagihan) }}</center></td>
                    </tr>
                    
                    @endforeach
                </tbody>
                
                <tfoot>
                        <tr>
                            <td colspan="6" align="right" valign="middle"><h5>total (Rp)</h5></td>
                            <td align="right"><h5><center>{{ number_format($total) }}</center></h5></td>
                        </tr>
                    </tfoot>

            </table>

            
    	</div>
	    
    </body>
</html>
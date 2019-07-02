
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
              <img src="{{ asset('admin/images/inventory.png') }}" style="width:120px; margin-top:-35px;" title="logo sbs" alt="logo sbs">
              <div style="margin-top: -25px; margin-left: 125px; font-size: 15px;"><strong>Body Repair Oven System</strong><br><br></div>
              <span style="margin-top: -15px;">{{ $title }}</span>
          </h4>

            <div class="col-md-6" style="float:left;">
				<span>{{ $transaksi->tanggal_pre }}</span>
                <h4>Data Pelanggan</h4>

                <table class="table" style="font-size: 12px;">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->no_claim }}</td></tr>
                </table>

            </div>

            <div class="col-md-6" style="float:right">
			<span>&nbsp;</span>
                <h4>Data Kendaraan</h4>

                <table class="table" style="font-size: 12px;">
                    <tr><th width="20%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->no_polisi }} / {{ $transaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $transaksi->sokendaraan->no_mesin }} / {{ $transaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $transaksi->sokendaraan->merek->nama_merek }} / {{ $transaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->warna_kendaraan }}</td></tr>
                </table>

            </div>

            <div style="margin-top: 180px">
                <table class="table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th align="center">#</th>
                            <th align="center">Keluhan</th>
                            <th align="center">Perbaikan</th>
                            <th align="center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                                                
                        @foreach($details as $index => $data)
                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->keluhan }}</td>
                            <td>{{ $data->perbaikan }}</td>
                            <td>{{ $data->keterangan }}</td>
                            
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

                <p></p>
                
            </div>

            
    	</div>
	    
    </body>
</html>
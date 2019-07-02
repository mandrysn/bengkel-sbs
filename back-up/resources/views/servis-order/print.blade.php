
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
              <img src="{{ asset('admin/images/inventory.png') }}" style="width:200px; margin-top:-5px; margin-bottom:-17px;" title="logo sbs" alt="logo sbs">
              <div style="margin-top: -30px; margin-left: 200px; "><strong>Body Repair Oven System</strong><br><br><br></div>
			  <span><p>{{ $title }}</p></span>
          </h4>

            <div class="col-md-5" style="float:left">

                <table class="table">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td width="20%">{{ $transaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $transaksi->sokendaraan->no_polisi }} / {{ $transaksi->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $transaksi->sokendaraan->no_mesin }} / {{ $transaksi->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $transaksi->sokendaraan->merek->nama_merek }} / {{ $transaksi->sokendaraan->merek->unit_merek }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $transaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $transaksi->sokendaraan->warna_kendaraan }}</td></tr>
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

            <div style="margin-top: 200px">
                <table class="table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>Keluhan</center></th>
                            <th><center>Perbaikan</center></th>
                            <th><center>Keterangan</center></th>
                        </tr>
                    </thead>
                    <tbody>
                                                
                        @foreach($details as $index => $data)
                        
                        <tr>
                            <td><center>{{ $index + 1 }}</center></td>
                            <td>{{ $data->keluhan }}</td>
                            <td>{{ $data->perbaikan }}</td>
                            <td>{{ $data->keterangan }}</td>
                            
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

                <p></p>
                
            </div>
			

            <div class="col-md-6">
					<h4><center>MOHON FOTO EPOXY</center></h4>
                    <h5>Pergantian Part</h5>

                    <table class="table">
					@foreach($gantis as $index => $data)
                        <tr><th>{{ $index + 1 }}.</th><td>{{ $data->keterangan_ganti }}</td></tr>
					@endforeach
                    </table>
    
                </div>

            
    	</div>
	    
    </body>
</html>
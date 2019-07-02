
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
                      <img src="{{ asset('admin/images/inventory.png') }}" style="width:160px; margin-left:-5px; margin-top:-30px; margin-bottom:-17px;" title="logo sbs" alt="logo sbs">
                      <div style="margin-top:-26px; margin-left: 150px; font-size: 16px;">
                        <strong>Body Repair Oven System</strong>
                        
                    </div>
                    </span>
                      <span style="float: right; margin-top:-30px; font-size: 13px;"><strong>PT. SINAR BORNEO SAMARINDA</strong><br>
                                JL. KH. Wahid Hasyim Gg. Salam No. 99A<br>
                                Samarinda-Kalimantan Timur<br>
                                Telp : 0541-4115027 / 0822 1306 9998<br>
                                Email : sbs.bodyshop@gmail.com<br>
                                Cabang Bontang : Jl. Poros Bontang - Samarinda KM.5</span>
                    
                  <div style="clear: both;"></div>
                  </h4>
                  <div class="col-md-6" style="float:left;">
                        <h4>Data Pengeluaran</h4>
        
                        <table class="table" style="font-size: 12px;">
                            <tr><th width="20%">Nomor Transaksi</th><td width="1%">:</td><td>{{ $pen->no_transaksi }}</td></tr>
                            <tr><th>Alamat</th><td>:</td><td>{{ $pen->tanggal_masuk }}</td></tr>
                        </table>
        
                    </div>

                <div class="col-md-6"  style="margin-top: 130px; font-size: 10px !important;">
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="40%">Opperasional</th>
                                    <th width="20%">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                
            </div>

            
    	</div>
	    
    </body>
</html>
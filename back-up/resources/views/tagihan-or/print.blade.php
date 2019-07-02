<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tagihan Or</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/cetak.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/boots.css') }}">
		<script>
            window.print();
        </script>
    </head>
    <body>

            <h4 class="page-header">
                    <span style="float: left">
                          <img src="{{ asset('admin/images/inventory.png') }}" style="width:200px; margin-left:-5px; margin-top:-5px; margin-bottom:-17px;" title="logo sbs" alt="logo sbs">
                          <div style="margin-top:-30px; margin-left: 180px; font-size: 18px;">
                            <strong><i>Body Repair Oven System</i></strong>
                            
                        </div>
                        </span>
                          <span style="float: right; font-size: 13px;"><strong>PT. SINAR BORNEO SAMARINDA</strong><br>
                                    JL. KH. Wahid Hasyim Gg. Salam No. 99A<br>
                                    Samarinda-Kalimantan Timur<br>
                                    Telp : 0541-4115027 / 0822 1306 9998<br>
                                    Email : sbs.bodyshop@gmail.com<br>
                                    Cabang Bontang : Jl. Poros Bontang - Samarinda KM.5</span>
                        
                      <div style="clear: both;"></div>
                      </h4>
		  
	

    <section id="biodata">
        <div class="header">
            <h1><center>TANDA TERIMA OR</center></h1>
        </div>
        <div class="content with-photo">
            <div style="font-size: 19px;">
                <table>
                    <tr>
                        <th width="100">Kepada</th>
                        <td>: </td>
						<td width="450">{{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
						<td>{{ $data->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}</td>
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
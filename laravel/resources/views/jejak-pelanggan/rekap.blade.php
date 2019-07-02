
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A Components Mix Bootstarp 3 Admin Dashboard Template">
    <meta name="author" content="Westilian">
    <title>MatMix - A Components Mix Admin Dashboard Template</title>
    <style type="text/css">
table {
	font: 9px/20px Verdana, Arial, Helvetica, sans-serif;
	border-collapse: collapse;
	width: auto;
	}

th {
	padding: 0 0.5em;
	text-align: left;
	}

tr.yellow td {
	border-top: 1px solid #FB7A31;
	border-bottom: 1px solid #FB7A31;
	}

td {
	border-bottom: 1px solid #CCC;
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
    </style>
</head>

<body>
        <span>Jejak Pelanggan</span>
    <table>
            <tr class="yellow"> 
                <td class="nomor" align="center">
                    No
                </td>
                <td class="date" align="center">
                    Tanggal Masuk
                </td>
                <td class="width" align="center">
                    Nama Pelanggan
                </td>
                <td class="mobil" align="center">
                    Merek / Unit Kendaraan
                </td>
                <td class="date" align="center">
                    Nomor Polisi
                </td>
                <td class="asuransi" align="center">
                    Asuransi
                </td>
                <td class="date" align="center">
                    Status Pekerjaan
                </td>
                <td class="date" align="center">
                    Status Pembayaran
                </td>
            </tr>
            @foreach($sot as $index => $data)
            <tr>
                <td class="adjacent">
                    {{ $index + 1 }}
                </td>
                <td class="adjacent">
                    {{ $data->tanggal_masuk }}
                </td>
                <td class="adjacent">
                    {{ $data->sotransaksi->sokendaraan->sopelanggan->nama_pelanggan }}
                </td>
                <td class="adjacent">
                    {{ $data->sotransaksi->sokendaraan->merek->nama_merek }} / {{ $data->sotransaksi->sokendaraan->merek->unit_merek }}
                </td>
                <td class="adjacent">
                    {{ $data->sotransaksi->sokendaraan->no_polisi }}
                </td>
                <td class="adjacent">
                    {{ $data->sotransaksi->asuransi_id == '0' ? $data->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi : $data->sotransaksi->asuransi->nama_asuransi }}
                </td>
                <td class="adjacent">
                    {{ $data->status_pekerjaan == 1 ? "WIP" : "Selesai" }}
                </td>
                <td class="adjacent adleft">
                    {{ $data->status_tagihan == 1 ? "Belum terbayar" : "Terbayar" }}
                </td>
            </tr>
            @endforeach
    </table>
</body>

</html>
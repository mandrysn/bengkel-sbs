
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
span {
	font: 9px/20px Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
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
	background: #FFC;
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
        <span>Status Pelanggan</span>
    <table>
            <tr class="yellow"> 
                <td class="nomor">
                    No
                </td>
                <td class="date">
                    Tanggal Masuk
                </td>
                <td class="width">
                    Nama Pelanggan
                </td>
                <td class="mobil">
                    Merek / Unit Kendaraan
                </td>
                <td class="date">
                    Nomor Polisi
                </td>
                <td class="asuransi">
                    Asuransi
                </td>
                <td class="date">
                    Status Pekerjaan
                </td>
                <td class="date">
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
                    {{ $data->sotransaksi->sokendaraan->sopelanggan->asuransi->nama_asuransi }}
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
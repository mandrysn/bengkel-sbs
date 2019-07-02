
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
span {
    font: 16px/20px Verdana, Arial, Helvetica, sans-serif;
}
    </style>
</head>

<body>
    <span>Bukti Keluar - Pengajuan Pembiayaan</span>
    <table>
            <tr class="yellow"> 
                <td class="nomor">
                    No
                </td>
                <td class="date" align="center">
                    Tanggal Masuk
                </td>
                <td class="no" align="center">
                    No. Bukti Barang Keluar
                </td>
                <td class="no" align="center">
                    Total
                </td>
            </tr>
            @php ($total_barang = 0)
            @foreach($sot as $index => $data)
            <tr>
                <td class="adjacent">
                    {{ $index + 1 }}
                </td>
                <td class="adjacent">
                    {{ $data->tanggal_masuk }}
                </td>
                <td class="adjacent">
                    {{ $data->bbk_material }}
                </td>
                <td class="adjacent adleft">
                        {{ number_format($tagihan_barang = $data->total) }}{{ Form::hidden('total',  $total_barang += $tagihan_barang) }}
                    </td>
            </tr>
            @endforeach
            <tr>
                    <td colspan="3" class="adjacent">total</td>
                    <td class="adjacent adleft">{{ number_format($total_barang) }}</td>
                </tr>
    </table>
</body>

</html>
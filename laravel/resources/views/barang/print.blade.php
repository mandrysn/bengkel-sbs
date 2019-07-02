
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A Components Mix Bootstarp 3 Admin Dashboard Template">
    <meta name="author" content="Westilian">
    <title>MatMix - A Components Mix Admin Dashboard Template</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}" type="text/css">
</head>

<body class="invoice-page">
    <div class="page-container iconic-view">
        <div class="page-content">

            <div class="main-container">
                <div class="invoice-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-title">
									<h2>SBS</h2>
									<span class="invoice-address">
									Office<br>
									Phone</span>
						<hr>
                                </div>
                            </div>
                            
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-id">
                                                    No
                                                </th>
												<th class="invoice-qty">
													Kode Barang
                                                </th>
                                                <th class="invoice-date">
                                                    Merek Kendaraan
                                                </th>
                                                <th class="invoice-type">
                                                    Nomor Part Barang
												</th>
                                                <th class="invoice-type">
                                                    Nama Barang
												</th>
                                                <th class="invoice-type">
                                                    Kategori Barang
												</th>
                                                <th class="invoice-type">
                                                    Harga Barang
												</th>
                                                <th class="invoice-type">
                                                    Jenis Satuan Barang
												</th>
                                                <th class="invoice-type">
                                                    Keterangan
												</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach($barang as $index => $data)
                                            <tr>
                                                <td class="invoice-type">
                                                    {{$index + 1}}
                                                </td>
                                                <td class="invoice-qty">
                                                    {{$data->kode_barang }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->merek->nama_merek }} / {{ $data->merek->unit_merek }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->no_part_barang }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->nama_barang }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->kategori_barang == 1 ? 'Spare Part' : 'Material' }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->harga_barang }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->satuan->nama_satuan }}
                                                </td>
                                                <td class="invoice-type">
                                                    {{ $data->keterangan }}
                                                </td>
											</tr>
											@endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <!--Rightbar Start Here -->

    </div>
</body>

</html>
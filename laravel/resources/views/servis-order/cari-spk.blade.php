@extends('template.template')

@section('content')
<script langauge="javascript">
        function post_value(pelanggan,id) {
        opener.document.getElementById('id_pelanggan').value = id;
        opener.document.getElementById('data_pelanggan').value = pelanggan;
        self.close();
        }
</script>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="so">

                        <h3 class="page-header">Cari SPK</h3>

        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No. Unit Lapor</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Merek / Type Kendaraan</th>
                                    <th>Nomor Polisi</th>
                                    <th>Asuransi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sot as $data)
                                    <tr>
                                        <td>{{ $data->no_transaksi }}</td>
                                        <td>{{ $data->tanggal_pre }}</td>
                                        <td>{{ $data->sokendaraan->sopelanggan->nama_pelanggan }}</td>
                                        <td>{{ $data->sokendaraan->merek->nama_merek }} / {{ $data->sokendaraan->merek->unit_merek }}</td>
                                        <td>{{ $data->sokendaraan->no_polisi }}</td>
                                        <td>{{ $data->asuransi_id == '0' ? $data->sokendaraan->sopelanggan->asuransi->nama_asuransi : $data->asuransi->nama_asuransi }}</td>
                                        <td><a href='#' onclick="post_value('{{ $data->no_transaksi }}, {{ $data->sokendaraan->no_polisi }}','{{ $data->id }}');">Pilih</a></td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        

                    </div>
        
                <div class="tab-pane"></div>
    
            </div>
@stop
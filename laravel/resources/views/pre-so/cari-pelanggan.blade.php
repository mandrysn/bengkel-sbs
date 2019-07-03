@extends('template.template')


@section('content')
<script langauge="javascript">
        function post_value(pelanggan,id) {
        opener.document.getElementById('so_kendaraan_id').value = id;
        opener.document.getElementById('data_pelanggan').value = pelanggan;
        self.close();
        }
</script>
            <h1 class="page-header">Cari Pelanggan</h1>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nomor Identitas Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>Kontak Pelanggan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggan as $data)
                        <tr>
                            <td>{{ $data->sopelanggan->no_claim }}</td>
                            <td>{{ $data->sopelanggan->nama_pelanggan }} / {{ $data->no_polisi }}</td>
                            <td>{{ $data->sopelanggan->alamat_pelanggan }}</td>
                            <td>{{ $data->sopelanggan->no_telpon_pelanggan }}</td>
                            <td><a href='#' onclick="post_value('{{ $data->no_polisi }} - {{ $data->sopelanggan->nama_pelanggan }}', '{{ $data->id }}');">Pilih</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

@endsection
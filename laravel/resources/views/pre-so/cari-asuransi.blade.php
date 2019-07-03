@extends('template.template')

@section('content')
<script langauge="javascript">
        function post_value(pelanggan,id) {
        opener.document.getElementById('asuransi_id').value = id;
        opener.document.getElementById('data_asuransi').value = pelanggan;
        self.close();
        }
</script>
            <h1 class="page-header">Cari Asuransi</h1>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Kode Asuransi</th>
                        <th>Nama Asuransi</th>
                        <th>Alamat Asuransi</th>
                        <th>Kontak Asuransi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asuransi as $data)
                        <tr>
                            <td>{{ $data->kode_asuransi }}</td>
                            <td>{{ $data->nama_asuransi }}</td>
                            <td>{{ $data->alamat_asuransi }}</td>
                            <td>{{ $data->no_telpon_asuransi }} / {{ $data->no_hp_asuransi }}</td>
                            <td><a href='#' onclick="post_value('{{ $data->nama_asuransi }}', '{{ $data->id }}');">Pilih</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            
@stop
@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            @include('template.notification')
            
            @include('template.form_pencarian')
            
            <p></p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>Kode Asuransi</th>
                        <th>Nama Asuransi</th>
                        <th>Alamat Asuransi</th>
                        <th>Kontak Asuransi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asuransi as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($asuransi->CurrentPage() - 1) * $asuransi->PerPage() ) }}</td>
                            <td>{{ $data->kode_asuransi }}</td>
                            <td>{{ $data->nama_asuransi }}</td>
                            <td>{{ $data->alamat_asuransi }}</td>
                            <td>{{ $data->no_telpon_asuransi }} / {{ $data->no_hp_asuransi }}</td>
                            <td>@include(
                                'template.aksi'
                            )</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $asuransi->links() }}
            
@stop
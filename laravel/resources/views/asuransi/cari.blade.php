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
                    @php ($index = 1)
                    @foreach ($asuransi as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->kode_asuransi }}</td>
                            <td>{{ $data->nama_asuransi }}</td>
                            <td>{{ $data->alamat_asuransi }}</td>
                            <td>{{ $data->no_telpon_asuransi }} / {{ $data->no_hp_asuransi }}</td>
                            <td>@include(
                                'template.aksi-i'
                            )</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            
@stop
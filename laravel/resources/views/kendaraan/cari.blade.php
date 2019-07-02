@extends('template.template')


@section('content')

            <h1 class="page-header">{{ $title }}</h1>
            
            @include('template.form_pencarian')
            
            <p></p>

            @include('template.notification')

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>Nomor Polisi</th>
                        <th>Merek / Unit Kendaraan</th>
                        <th>Nomor Mesin</th>
                        <th>Nomor Rangka</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($index = 1)
                    @foreach($kendaraan as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->no_polisi }}</td>
                            <td>{{ $data->merek->nama_merek }} / {{ $data->merek->unit_merek }}</td>
                            <td>{{ $data->no_mesin }}</td>
                            <td>{{ $data->no_rangka }}</td>
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

@endsection
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraan as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($kendaraan->CurrentPage() - 1) * $kendaraan->PerPage() ) }}</td>
                            
                            <td>{{ $data->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $data->no_polisi }}</td>
                            <td>{{ $data->merek->nama_merek }} / {{ $data->merek->unit_merek }}</td>
                            
                            <td>@include('template.aksi')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $kendaraan->links() }}
@endsection
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
                        <th>Kode Merek</th>
                        <th>Jenis Merek</th>
                        <th>Type Merek</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($index = 1)
                    @foreach($merek as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->kode_merek }}</td>
                            <td>{{ $data->nama_merek }}</td>
                            <td>{{ $data->unit_merek }}</td>
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

@endsection
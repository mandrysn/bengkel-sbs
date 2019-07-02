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
                        <th>Kode Satuan</th>
                        <th>Nama Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($index = 1)
                    @foreach ($satuan as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->kode_satuan }}</td>
                            <td>{{ $data->nama_satuan }}</td>
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
@endsection
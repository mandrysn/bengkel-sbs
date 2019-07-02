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
                        <th>Nama Operasional</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($index = 1)
                    @foreach($operasional as $data)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $data->nama_operasional }}</td>
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

@endsection
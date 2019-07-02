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
                    @foreach($operasional as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($operasional->CurrentPage() - 1) * $operasional->PerPage() ) }}</td>
                            <td>{{ $data->nama_operasional }}</td>
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $operasional->links() }}

@endsection
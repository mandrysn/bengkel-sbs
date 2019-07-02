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

                        <th>Nama Grup</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($group as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($group->CurrentPage() - 1) * $group->PerPage() ) }}</td>
                            <td>{{ $data->nama_group }}</td>
                            <td>@include('template.aksi')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $group->links() }}
@endsection
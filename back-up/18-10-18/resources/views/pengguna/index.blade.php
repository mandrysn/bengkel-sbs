@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>
            @include('template.tambah')
            <p></p>

            @include('template.notification')

<table class="table table-bordered table-hover">

	<thead>

		<tr>

			<th>No</th>

			<th>Nama</th>

			<th>email</th>

			<th>Grup</th>

			<th>Aksi</th>

		</tr>

	</thead>

	<tbody>

@foreach($user as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($user->CurrentPage() - 1) * $user->PerPage() ) }}</td>

				<td>{{ $data->name }}</td>

				<td>{{ $data->email }}</td>

				<td>{{ $data->group->nama_group }}</td>

                            <td>@include('template.aksi')</td>
                        </tr>
                    @endforeach
			
	</tbody>

</table>

{{ $user->links() }}

@stop
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
                        <th>Nomor Identitas Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>Kontak Pelanggan</th>
                        {{--<th>Asuransi Pelanggan</th>--}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggan as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($pelanggan->CurrentPage() - 1) * $pelanggan->PerPage() ) }}</td>
                            <td>{{ $data->no_claim }}</td>
                            <td>{{ $data->nama_pelanggan }}</td>
                            <td>{{ $data->alamat_pelanggan }}</td>
                            <td>{{ $data->no_telpon_pelanggan }}</td>
								{{--<td>{{ $data->asuransi->nama_asuransi }}</td>--}}
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $pelanggan->links() }}
            
@endsection
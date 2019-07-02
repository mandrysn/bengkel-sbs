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
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Kontak Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suplier as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($suplier->CurrentPage() - 1) * $suplier->PerPage() ) }}</td>
                            <td>{{ $data->kode_suplier }}</td>
                            <td>{{ $data->nama_suplier }}</td>
                            <td>{{ $data->alamat_suplier }}</td>
                            <td>{{ $data->no_telpon_suplier }} / {{ $data->no_hp_suplier }}</td>
                            <td>@include('template.aksi-i')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $suplier->links() }}

@stop
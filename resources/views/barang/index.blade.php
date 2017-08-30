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
                        <th>Kode Barang/Barcode</th>
                        <th>No Part Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori Barang</th>
                        <th>Merek / Type Barang</th>
                        <th>Harga Barang</th>
                        <th>Satuan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($barang->CurrentPage() - 1) * $barang->PerPage() ) }}</td>
                            <td>{{ $data->kode_barang }}</td>
                            <td>{{ $data->no_part_barang }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->kategori_barang > 1 ? 'Spare Part' : 'Material' }}</td>
                            <td>{{ $data->merek->nama_merek }} / {{ $data->merek->unit_merek }}</td>
                            <td align="right">{{ number_format($data->harga_barang) }} (Rp)</td>
                            <td>{{ $data->satuan->kode_satuan }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>@include('template.aksi')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $barang->links() }}

@stop
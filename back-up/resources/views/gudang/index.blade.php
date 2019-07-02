@extends('template.template')


@section('content')
            <h1 class="page-header">{{ $title }}</h1>
            
            {!! Form::open(['url' => $route.'/cari', 'method' => 'GET', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci']) !!}
                    
                    {!! Form::button('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                
            {!! Form::close() !!}
            
            <p></p>


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Nomor Part Barang</th>
                        <th>Suplier</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gudang as $index => $data)
                        <tr>
                            <td>{{ $index + 1 + ( ($gudang->CurrentPage() - 1) * $gudang->PerPage() ) }}</td>
                            <td>{{ $data->barang->kode_barang }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->barang->no_part_barang }}</td>
                            <td>{{ $data->suplier->nama_suplier }}</td>
                            <td>{{ $data->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $gudang->links() }}

@endsection
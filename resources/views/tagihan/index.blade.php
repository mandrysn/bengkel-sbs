@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            @if (!empty($message)):
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ $message }}</p>
                </div>
            @endif
            
            <div class="row">
                <div class="col-lg-6">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" name="q" placeholder="Pencarian">
                        </div>
                        <button type="submit" class="btn btn-default">Cari</button>
                        <a href="{{ route('tagihan.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form class="form-inline" action="" method="POST">
                        <input type="text" class="form-control date-picker" value="" name="awal" id="awal" placeholder="Pilih Bulan Awal" required> s/d
                        <input type="text" class="form-control date-picker" value="" name="akhir" id="akhir" placeholder="Pilih Bulan AKhir" required>
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <p></p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th>No. Servis Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Merek / Type Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Asuransi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php( $no = 1 )
                    @foreach ($tagihans as $tagihan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $tagihan->kode_transaksi }}</td>
                            <td>{{ $tagihan->sopelanggan->nama_pelanggan }}</td>
                            <td>{{ $tagihan->sokendaraan->merek_kendaraan }} / {{ $tagihan->sokendaraan->type_kendaraan }}</td>
                            <td>{{ $tagihan->sokendaraan->no_polisi }}</td>
                            <td>{{ $tagihan->sopelanggan->asuransi->nama_asuransi }}</td>
                            <td>
                                <form method="DELETE" action="{{ route('tagihan.destroy', $tagihan->id) }}" accept-charset="UTF-8">
                                    <a href="{{ route('tagihan.edit', $tagihan->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Ubah</a>
                                    <a href="" class="btn btn-success"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

@stop
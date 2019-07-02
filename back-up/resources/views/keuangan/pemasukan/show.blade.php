@extends('template.template')

@section('content')
<style type="text/css">
	#gambar{
		max-width: 100%;
	}
	@media screen and (max-width: 1199px) {
	  #gambar {
	   	float: none;
		margin-top: 5px;
		margin-bottom: 5px;
	  }
	}

</style>
            <h1 class="page-header">{{ $title }}</h1>
            <div class="col-md-6">
                <h2>Data Pelanggan</h2>

                <table class="table" width="50%">
                    <tr><th width="20%">Nama Pelanggan</th><td width="1%">:</td><td>{{ $sot->sopelanggan->nama_pelanggan }}</td></tr>
                    <tr><th>Alamat</th><td>:</td><td>{{ $sot->sopelanggan->alamat_pelanggan }}</td></tr>
                    <tr><th>No. Telpon</th><td>:</td><td>{{ $sot->sopelanggan->no_telpon_pelanggan }}</td></tr>
                    <tr><th>Asuransi</th><td>:</td><td>{{ $sot->sopelanggan->asuransi->nama_asuransi }}</td></tr>
                    <tr><th>No. Claim</th><td>:</td><td>{{ $sot->sopelanggan->no_claim }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <h2>Data Kendaraan</h2>

                <table class="table">
                    <tr><th width="20%">No. Polisi / Tahun</th><td width="1%">:</td><td>{{ $sot->sokendaraan->no_polisi }} / {{ $sot->sokendaraan->tahun_kendaraan }}</td></tr>
                    <tr><th>No. Mesin / Rangka</th><td>:</td><td>{{ $sot->sokendaraan->no_mesin }} / {{ $sot->sokendaraan->no_rangka }}</td></tr>
                    <tr><th>Merek / Type Unit</th><td>:</td><td>{{ $sot->sokendaraan->merek_kendaraan }} / {{ $sot->sokendaraan->type_kendaraan }}</td></tr>
                    <tr><th>KM Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->km_kendaraan }}</td></tr>
                    <tr><th>Warna Kendaraan</th><td>:</td><td>{{ $sot->sokendaraan->warna_kendaraan }}</td></tr>
                </table>

            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr><th width="20%">Tanggal Masuk</th><td width="1%">:</td><td>{{ $sot->sokendaraan->tanggal_masuk }}</td></tr>
                    <tr><th>Ekstimasi Tanggal Keluar</th><td>:</td><td>{{ $sot->sokendaraan->tanggal_selesai }}</td></tr>
                </table>

	            <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item/Pekerjaan</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sob as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->quantity }} {{ $data->barang->satuan->kode_satuan }}</td>
                            <td>{{ $data->keterangan }}</td>
                        </tr>
                        @endforeach

                        @foreach($soj as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            <td>{{ $data->quantity }} Kali</td>
                            <td>{{ $data->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
	            </table>
	
            </div>

            <div class="col-md-6">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{!! Html::image(asset('asset/order/kiri/'.$sot->sokendaraan->foto_kiri), null, ['class'=> 'img-rounded img-responsive' , 'id' => 'gambar']) !!}</th>
                            <th>{!! Html::image(asset('asset/order/kanan/'.$sot->sokendaraan->foto_kanan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>{!! Html::image(asset('asset/order/depan/'.$sot->sokendaraan->foto_depan), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                            <th>{!! Html::image(asset('asset/order/belakang/'.$sot->sokendaraan->foto_belakang), null, ['class'=> 'img-rounded img-responsive', 'id' => 'gambar']) !!}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            
@stop
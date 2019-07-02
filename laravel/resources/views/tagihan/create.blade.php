@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>

            <form class="form-horizontal" method="POST" action="{{ route('barang.store') }}">
                <div class="form-group">
                    <label for="kode" class="col-lg-2 control-label">Kode Barang/Barcode</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="kode_barang" id="kode" placeholder="Kode Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">No. Part Barang</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="no_part_barang" id="nomor" placeholder="No Part Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">Nama Barang</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="nama_barang" id="nama" placeholder="Nama Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">Kategori Barang</label>
                    <select class="form-control selectpicker" name="kategori_barang" id="kategori" data-live-search="true">
                        <option></option>
                            <option value="1">Material</option>		
                            <option value="2">Spare Part</option>		
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">Merek Kendaraan</label>
                    <div class="col-lg-3">
                        <select onchange="getsnen(this.value)" class="form-control selectpicker" name="merek" id="merek" data-live-search="true">
                            <option></option>
                            @foreach ($mereks as $merek):
                                <option value="{{ $merek->id }}">{{ $merek->nama_merek }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">Type Unit</label>
                    <div class="col-lg-3">
                        <select class="form-control selectpicker" name="merek_id" id="merek" data-live-search="true">
                            <option></option>
                            @foreach ($mereks as $merek):
                                <option value="{{ $merek->id }}">{{ $merek->type_merek }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">Harga Barang</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="harga_barang" id="harga" placeholder="Harga Barang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-lg-2 control-label">Satuan Barang</label>
                    <div class="col-lg-3">
                        <select class="form-control selectpicker" name="satuan_id" id="merek" data-live-search="true">
                            <option></option>
                            @foreach ($satuans as $satuan):
                                <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input type=button value=Batal class="btn btn-default" onclick=self.history.back()>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
            
@stop
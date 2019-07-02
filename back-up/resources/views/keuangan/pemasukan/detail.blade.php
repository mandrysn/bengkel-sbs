@extends('template.template')

@section('content')
            <h1 class="page-header">{{ $title }}</h1>
            <div class="row">
                <div class="col-md-5">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nomor Permintaan</th><th>:</th><td><?php echo @$r->nomor ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th><th>:</th><td><?php echo @$r->tanggal ?></td>
                        </tr>
                        <tr>
                            <th>Kode Unit</th><th>:</th><td><?php echo @$r->kode_unit ?></td>
                        </tr>
                        <tr>
                            <th>Type/Jenis</th><th>:</th><td><?php echo  $this->Mpurchase_request->getMerekOne($r->merek_id)->kode; ?> / <?php echo  $this->Mpurchase_request->getMerekOne($r->merek_id)->nama; ?></td>
                        </tr>
                        <tr>
                            <th>E/N No.</th><th>:</th><td><?php echo @$r->merek->no_en ?></td>
                        </tr>
                        <tr>
                            <th>S/N No.</th><th>:</th><td><?php echo @$r->merek->no_sn ?></td>
                        </tr>
                        <tr>
                            <th>Sifat</th><th>:</th><td><?php echo (@$r->sifat == 0) ? "Biasa" : "Urgent" ?></td>
                        </tr>
                        <tr>
                            <th>Nama Merek</th><th>:</th><td><?php echo $r->merek->nama ?></td>
                        </tr>
                        <tr>
                            <th>Merek Unit</th><th>:</th><td><?php echo $r->merek->unit ?></td>
                        </tr>
                        <tr>
                            <th>Diketahui Oleh</th><th>:</th><td><?php echo @$r->diketahui->nama; ?></td>
                        </tr>
                        <tr>
                            <th>Diperiksa Oleh</th><th>:</th><td><?php echo @$r->diperiksa->nama; ?></td>
                        </tr>
                        <tr>
                            <th>Disetujui Oleh</th><th>:</th><td><?php echo @$r->disetujui->nama; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Halaman</th>
                            <th>Indeks</th>
                            <th width="100px">Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Satuan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1 ?>
                        <?php foreach ($r->detail as $d): ?>
                            <tr>
                                <form action="<?php echo $aksi_update_detail ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $d->id ?>">
                                    <input type="hidden" name="permintaan_id" value="<?php echo $this->uri->segment(3) ?>">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $d->barang->kode ?></td>
                                    <td><?php echo $d->barang->nama ?></td>
                                    <td><?php echo $d->barang->halaman ?></td>
                                    <td><?php echo $d->barang->indeks ?></td>
                                    <td><?php echo $d->jumlah ?></td>
                                    <td align="right"><?php echo number_format($d->barang->harga); ?></td>
                                    <td align="right"><?php echo number_format($d->barang->harga * $d->jumlah); ?></td>
                                    <td><?php echo $d->barang->satuan->nama ?></td>
                                    <td><?php echo $d->barang->keterangan ?></td>
                                </form>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                </div>
            </div>

@stop
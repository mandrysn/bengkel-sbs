<?php $this->load->view('_header') ?>
<?php
	
	$hutang_tambah		= "";
	$hutang_hapus		= "";
	$hutang_lihat		= "";
	$hutang_ubah		= "";
	$piutang_tambah		= "";
	$piutang_hapus		= "";
	$piutang_lihat		= "";
	$piutang_ubah		= "";
	$wtp_tambah			= "";
	$wtp_hapus			= "";
	$wtp_lihat			= "";
	$wtp_ubah			= "";
	$laporan_tambah		= "";
	$laporan_lihat		= "";
	$laporan_hapus		= "";
	$laporan_ubah		= "";
	$pengguna_tambah	= "";
	$pengguna_hapus		= "";
	$pengguna_ubah		= "";
	$pengguna_lihat		= "";
	$pelanggan_tambah	= "";
	$pelanggan_hapus	= "";
	$pelanggan_ubah		= "";
	$pelanggan_lihat	= "";
	$lokasi_tambah		= "";
	$lokasi_hapus		= "";
	$lokasi_ubah		= "";
	$lokasi_lihat		= "";
	$profil_ubah		= "";
	$log_lihat			= "";

				if ($level->hutang_tambah == 1) $hutang_tambah = "checked";
				if ($level->hutang_hapus == 1) $hutang_hapus = "checked";
				if ($level->hutang_lihat == 1) $hutang_lihat = "checked";
				if ($level->hutang_ubah == 1) $hutang_ubah = "checked";
				if ($level->piutang_tambah == 1) $piutang_tambah = "checked";
				if ($level->piutang_hapus == 1) $piutang_hapus = "checked";
				if ($level->piutang_lihat == 1) $piutang_lihat = "checked";
				if ($level->piutang_ubah == 1) $piutang_ubah = "checked";
				if ($level->wtp_tambah == 1) $wtp_tambah = "checked";
				if ($level->wtp_hapus == 1) $wtp_hapus = "checked";
				if ($level->wtp_lihat == 1) $wtp_lihat = "checked";
				if ($level->wtp_ubah == 1) $wtp_ubah = "checked";
				if ($level->laporan_tambah == 1) $laporan_tambah = "checked";
				if ($level->laporan_lihat == 1) $laporan_lihat = "checked";
				if ($level->laporan_hapus == 1) $laporan_hapus = "checked";
				if ($level->laporan_ubah == 1) $laporan_ubah = "checked";
				if ($level->pengguna_tambah == 1) $pengguna_tambah = "checked";
				if ($level->pengguna_hapus == 1) $pengguna_hapus = "checked";
				if ($level->pengguna_ubah == 1) $pengguna_ubah = "checked";
				if ($level->pengguna_lihat == 1) $pengguna_lihat = "checked";
				if ($level->pelanggan_tambah == 1) $pelanggan_tambah = "checked";
				if ($level->pelanggan_hapus == 1) $pelanggan_hapus = "checked";
				if ($level->pelanggan_ubah == 1) $pelanggan_ubah = "checked";
				if ($level->pelanggan_lihat == 1) $pelanggan_lihat = "checked";
				if ($level->lokasi_tambah == 1) $lokasi_tambah = "checked";
				if ($level->lokasi_hapus == 1) $lokasi_hapus = "checked";
				if ($level->lokasi_ubah == 1) $lokasi_ubah = "checked";
				if ($level->lokasi_lihat == 1) $lokasi_lihat = "checked";
				if ($level->profil_ubah == 1) $profil_ubah = "checked";
				if ($level->log_lihat == 1) $log_lihat = "checked";

?>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="box-widget widget-module">
			<div class="widget-head clearfix">
				<span class="h-icon"><i class="fa fa-plus"></i></span>
					<h4>Edit Pengguna</h4>
				</div>
			<div class="widget-container">
				<div class="widget-block">
				<?php echo $this->session->flashdata('status'); ?>
				<div id="alert"></div>
				<?=form_open_multipart('Pengguna/edit/'.$this->uri->segment(3), array('class' => 'form-horizontal'));?>
						<div class="form-group">
							<label class="col-md-2 control-label">Username*</label>
							<div class=" col-md-4">
								<input type="text" name="username" disabled value="<?=$row->username?>" id="username" required class="form-control" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password*</label>
							<div class=" col-md-4">
								<input type="password" id="txtNewPassword" onkeyup="checkPasswordMatch()" name="password" class="form-control" placeholder="Password">
								<p class="input-instruction">Tidak perlu diisi apabila tidak diganti</p>
							</div>
							<label class="col-md-2 control-label">Gambar </label>
							<div class="col-md-4">
								<img src="<?=base_url('uploads/users/').$row->gambar?>" class="img img-responsive" height="50px" width="50px">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Ulangi Password*</label>
							<div class=" col-md-4">
								<input type="password" id="txtConfirmPassword" onkeyup="checkPasswordMatch()" name="password2" class="form-control" placeholder="Ulangi Password">
							</div>
							<label class="col-md-2 control-label">&nbsp; </label>
							<div class="col-md-4">
								<input type="file" class="filestyle" name="uploadedimages">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Pengguna*</label>
							<div class=" col-md-4">
								<input type="text" name="nama" value="<?=$row->nama?>" required class="form-control" placeholder="Nama">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Alamat Pengguna</label>
							<div class=" col-md-4">
								<textarea class="form-control" name="alamat" placeholder="Alamat"><?=$row->alamat?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nomor Telepon</label>
							<div class=" col-md-4">
								<input type="text" name="no_telp"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?=$row->no_telp?>" class="form-control" placeholder="Telepon">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">&nbsp;</label>
								<div class="col-md-8">
									<div class="form-actions">
										<button type="submit" id="btn" class="btn btn-primary">Simpan</button>
										<button type="reset" value="reset" class="btn btn-default">Cancel</button>
									</div>
								</div>
						</div>
						<div class="form-group">
						<div class="col-md-12">
						<p><small>* Jika ingin mengaktifkan fitur hapus atau ubah maka centang lihat.</small></p>
							<table class="table table-responsive table-bordered table-striped">
								<thead>
									<tr class="success">
										<th width="15%"><b><center>Nama Menu</center></b></th>
										<th width="10%"><b><center>Tambah</center></b></th>
										<th width="10%"><b><center>Hapus</center></b></th>
										<th width="10%"><b><center>Ubah</center></b></th>
										<th width="10%"><b><center>Lihat</center></b></th>
										<th class="danger" width="10%"><b><center>Pilih Semua</center></b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Kartu Hutang</td>
										<td><center><input type="checkbox" class="s1" <?php echo $hutang_tambah;?> name="hutang_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s1 a1" <?php echo $hutang_hapus;?> name="hutang_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s1 a1" <?php echo $hutang_ubah;?> name="hutang_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s1 l1" <?php echo $hutang_lihat;?> name="hutang_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all1" /></center></td>
									</tr>
									<tr>
										<td>Kartu Piutang</td>
										<td><center><input type="checkbox" class="s4" <?php echo $piutang_tambah;?> name="piutang_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s4 a2" <?php echo $piutang_hapus;?> name="piutang_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s4 a2" <?php echo $piutang_ubah;?> name="piutang_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s4 l2" <?php echo $piutang_lihat;?>  name="piutang_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all4" /></center></td>
									</tr>
									<tr>
										<td>Kartu WTP</td>
										<td><center><input type="checkbox" class="s6" <?php echo $wtp_tambah;?> name="wtp_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s6 a3" <?php echo $wtp_hapus;?> name="wtp_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s6 a3" <?php echo $wtp_ubah;?> name="wtp_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s6 l3" <?php echo $wtp_lihat;?> name="wtp_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all6" /></center></td>
									</tr>
									<tr>
										<td>Pengguna</td>
										<td><center><input type="checkbox" class="s5" <?php echo $pengguna_tambah;?> name="pengguna_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s5 a4" <?php echo $pengguna_hapus;?> name="pengguna_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s5 a4" <?php echo $pengguna_ubah;?> name="pengguna_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s5 l4" <?php echo $pengguna_lihat;?> name="pengguna_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all5" /></center></td>
									</tr>
									<tr>
										<td>Log Pengguna</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><center><input type="checkbox" class="s8" <?php echo $log_lihat;?> name="log_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all8" /></center></td>
									</tr>
									<tr>
										<td>Pelanggan</td>
										<td><center><input type="checkbox" class="s2" <?php echo $pelanggan_tambah;?> name="pelanggan_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s2 a6" <?php echo $pelanggan_hapus;?> name="pelanggan_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s2 a6" <?php echo $pelanggan_ubah;?> name="pelanggan_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s2 l6" <?php echo $pelanggan_lihat;?> name="pelanggan_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all2" /></center></td>
									</tr>
									<tr>
										<td>Lokasi Perumahan</td>
										<td><center><input type="checkbox" class="s3" <?php echo $lokasi_tambah;?> name="lokasi_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s3 a5" <?php echo $lokasi_hapus;?> name="lokasi_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s3 a5" <?php echo $lokasi_ubah;?> name="lokasi_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s3 l5" <?php echo $lokasi_lihat;?> name="lokasi_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all3" /></center></td>
									</tr>
									<tr>
										<td>Laporan</td>
										<td><center><input type="checkbox" class="s7" <?php echo $laporan_tambah;?> name="laporan_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s7 a7" <?php echo $laporan_hapus;?> name="laporan_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s7 a7" <?php echo $laporan_ubah;?> name="laporan_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s7 l7" <?php echo $laporan_lihat;?> name="laporan_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all7" /></center></td>
									</tr>
									<tr>
										<td>Profil</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><center><input type="checkbox" class="s9" <?php echo $profil_ubah;?> name="profil_ubah" value="1"></center></td>
										<td>&nbsp;</td>
										<td><center><input type="checkbox" id="select_all9" /></center></td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">


jQuery("#select_all1").click(function () {
     jQuery('.s1').not(this).prop('checked', this.checked);
 });

jQuery("#select_all2").click(function () {
     jQuery('.s2').not(this).prop('checked', this.checked);
 });
 
 jQuery("#select_all3").click(function () {
     jQuery('.s3').not(this).prop('checked', this.checked);
 });

 jQuery("#select_all4").click(function () {
     jQuery('.s4').not(this).prop('checked', this.checked);
 });

 jQuery("#select_all5").click(function () {
     jQuery('.s5').not(this).prop('checked', this.checked);
 });

 jQuery("#select_all6").click(function () {
     jQuery('.s6').not(this).prop('checked', this.checked);
 });

  jQuery("#select_all7").click(function () {
     jQuery('.s7').not(this).prop('checked', this.checked);
 });

jQuery("#select_all8").click(function () {
     jQuery('.s8').not(this).prop('checked', this.checked);
 });

jQuery("#select_all9").click(function () {
     jQuery('.s9').not(this).prop('checked', this.checked);
 });

<!-- -->

jQuery(".a1").click(function () {
	jQuery('.l1').not(this).prop('checked', this.checked);
});

jQuery(".a2").click(function () {
	jQuery('.l2').not(this).prop('checked', this.checked);
});

jQuery(".a3").click(function () {
	jQuery('.l3').not(this).prop('checked', this.checked);
});

jQuery(".a4").click(function () {
	jQuery('.l4').not(this).prop('checked', this.checked);
});

jQuery(".a5").click(function () {
	jQuery('.l5').not(this).prop('checked', this.checked);
});

jQuery(".a6").click(function () {
	jQuery('.l6').not(this).prop('checked', this.checked);
});

jQuery(".a7").click(function () {
	jQuery('.l7').not(this).prop('checked', this.checked);
});

function check_username(username) {
   	jQuery.ajax({
 			type: "GET",
            url: "<?=base_url('Pengguna/cek_user')?>",
            data: "username="+username,
            success:function(html){
             	if (html == "gagal"){
             		jQuery('#alert').html('<div class="alert alert-danger"><b><i class="fa fa-warning"></i></b> Username ini tidak dapat digunakan<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div><script>');
             		jQuery("#btn").prop("disabled", true);
             	}else{
             		jQuery('#alert').html('<div class="alert alert-success"><i class="fa fa-check"></i> Username ini dapat digunakan<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div>');
             		jQuery("#btn").prop("disabled", false);
             	}
            }
 			});		
   }

function checkPasswordMatch() {
    var password = jQuery("#txtNewPassword").val();
    var confirmPassword = jQuery("#txtConfirmPassword").val();

    if (password != confirmPassword){
        jQuery("#alert").html('<div class="alert alert-danger"><b><i class="fa fa-warning"></i></b> Password belum cocok<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div>');
        jQuery("#btn").prop("disabled", true);
    } else{
        jQuery("#alert").html('<div class="alert alert-success"><i class="fa fa-check"></i> Password sudah sesuai<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div>');
        jQuery("#btn").prop("disabled", false);
    }
}

$("input#username").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
</script>

<?php $this->load->view('_footer') ?>
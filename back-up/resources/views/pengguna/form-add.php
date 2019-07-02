<?php $this->load->view('_header') ?>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="box-widget widget-module">
			<div class="widget-head clearfix">
				<span class="h-icon"><i class="fa fa-plus"></i></span>
					<h4>Tambah Pengguna</h4>
				</div>
			<div class="widget-container">
				<div class="widget-block">
				<?php echo $this->session->flashdata('status'); ?>
				<div id="alert_user"></div>
				<div id="alert"></div>
				<?=form_open_multipart('Pengguna/add', array('class' => 'form-horizontal'));?>
						<div class="form-group">
							<label class="col-md-2 control-label">Username*</label>
							<div class=" col-md-4">
								<input type="text" name="username" id="username" onkeyup="check_username(this.value)" required class="form-control" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password*</label>
							<div class=" col-md-4">
								<input type="password" id="txtNewPassword" onkeyup="checkPasswordMatch()" name="password" required class="form-control" placeholder="Password">
							</div>
							<label class="col-md-2 control-label">Gambar </label>
							<div class="col-md-4">
								<input type="file" class="filestyle" name="uploadedimages">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Ulangi Password*</label>
							<div class=" col-md-4">
								<input type="password" id="txtConfirmPassword" onkeyup="checkPasswordMatch()" name="password2" required class="form-control" placeholder="Ulangi Password">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Pengguna*</label>
							<div class=" col-md-4">
								<input type="text" name="nama" required class="form-control" placeholder="Nama">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Alamat Pengguna</label>
							<div class=" col-md-4">
								<textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nomor Telepon</label>
							<div class=" col-md-4">
								<input type="text" name="no_telp"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" placeholder="Telepon">
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
										<td><center><input type="checkbox" class="s1" name="hutang_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s1 a1" onclick="autolihat1()" name="hutang_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s1 a1" onclick="autolihat1()" name="hutang_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s1 l1"  name="hutang_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all1" /></center></td>
									</tr>
									<tr>
										<td>Kartu Piutang</td>
										<td><center><input type="checkbox" class="s4" name="piutang_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s4 a2" name="piutang_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s4 a2"  name="piutang_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s4 l2"  name="piutang_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all4" /></center></td>
									</tr>
									<tr>
										<td>Kartu WTP</td>
										<td><center><input type="checkbox" class="s6" name="wtp_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s6 a3" name="wtp_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s6 a3"  name="wtp_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s6 l3"  name="wtp_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all6" /></center></td>
									</tr>
									<tr>
										<td>Pengguna</td>
										<td><center><input type="checkbox" class="s5" name="pengguna_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s5 a4" name="pengguna_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s5 a4" name="pengguna_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s5 l4" name="pengguna_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all5" /></center></td>
									</tr>
									<tr>
										<td>Log Pengguna</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><center><input type="checkbox" name="log_lihat" class="s8" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all8" /></center></td>
									</tr>
									<tr>
										<td>Pelanggan</td>
										<td><center><input type="checkbox" class="s2" name="pelanggan_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s2 a5" name="pelanggan_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s2 a5" name="pelanggan_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s2 l5" name="pelanggan_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all2" /></center></td>
									</tr>
									<tr>
										<td>Lokasi Perumahan</td>
										<td><center><input type="checkbox" class="s3" name="lokasi_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s3 a6" name="lokasi_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s3 a6" name="lokasi_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s3 l6" name="lokasi_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all3" /></center></td>
									</tr>
									<tr>
										<td>Laporan</td>
										<td><center><input type="checkbox" class="s7" name="laporan_tambah" value="1"></center></td>
										<td><center><input type="checkbox" class="s7 a7"  name="laporan_hapus" value="1"></center></td>
										<td><center><input type="checkbox" class="s7 a7"  name="laporan_ubah" value="1"></center></td>
										<td><center><input type="checkbox" class="s7 l7" name="laporan_lihat" value="1"></center></td>
										<td><center><input type="checkbox" id="select_all7" /></center></td>
									</tr>
									<tr>
										<td>Profil</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><center><input type="checkbox" class="s9" name="profil_ubah" value="1"></center></td>
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
             	jQuery('#alert_user').html('<div class="alert alert-danger"><b><i class="fa fa-warning"></i></b> Username ini tidak dapat digunakan<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div><script>');
             		tutup_tombol();
             	}else{
             		jQuery('#alert_user').html('<div class="alert alert-success"><i class="fa fa-check"></i> Username ini dapat digunakan<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div>');
             		buka_tombol();
             	}
            }
 			});		
   }

function checkPasswordMatch() {
    var password = jQuery("#txtNewPassword").val();
    var confirmPassword = jQuery("#txtConfirmPassword").val();
    var user = jQuery('#username').val();

    if (password != confirmPassword){
        jQuery("#alert").html('<div class="alert alert-danger"><b><i class="fa fa-warning"></i></b> Password belum cocok<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div>');
        tutup_tombol();
    } else{
        jQuery("#alert").html('<div class="alert alert-success"><i class="fa fa-check"></i> Password sudah sesuai<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button></div>');
        buka_tombol();
      	check_username(user);
    }
}

function buka_tombol() {
    jQuery("#btn").prop("disabled", false);
}

function tutup_tombol() {
    jQuery("#btn").prop("disabled", true);
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
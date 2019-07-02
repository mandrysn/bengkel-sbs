<?php $this->load->view('_header') ?>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="box-widget widget-module">
			<div class="widget-head clearfix">
				<span class="h-icon"><i class="fa fa-plus"></i></span>
					<h4>Profile Saya</h4>
				</div>
			<div class="widget-container">
				<div class="widget-block">
				<?php echo $this->session->flashdata('status'); ?>
				<div id="alert"></div>
				<?=form_open_multipart('Pengguna/my_profile/', array('class' => 'form-horizontal'));?>
						<div class="form-group">
							<label class="col-md-2 control-label">Username*</label>
							<div class=" col-md-4">
								<input type="text" name="" disabled value="<?=$row->username?>" id="username" required class="form-control" placeholder="Username">
							</div>
							<label class="col-md-2 control-label">Gambar </label>
							<div class="col-md-4">
								<img src="<?=base_url('uploads/users/').$row->gambar?>" class="img img-responsive" height="50px" width="50px">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password*</label>
							<div class=" col-md-4">
								<input type="password" id="txtNewPassword" onkeyup="checkPasswordMatch()" name="password" class="form-control" placeholder="Password">
								<p class="input-instruction">Tidak perlu diisi apabila tidak diganti</p>
							</div>
							<label class="col-md-2 control-label">&nbsp; </label>
							<div class="col-md-4">
								<input type="file" class="filestyle" name="uploadedimages">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Ulangi Password*</label>
							<div class=" col-md-4">
								<input type="password" id="txtConfirmPassword" onkeyup="checkPasswordMatch()" name="password2" class="form-control" placeholder="Ulangi Password">
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
								<input type="text" name="no_telp" value="<?=$row->no_telp?>" class="form-control" placeholder="Telepon">
								<input type="hidden" name="username" value="<?=$row->username?>"></input>
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
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
 jQuery(document).ready(function(){
	jQuery("#txtNewPassword, #txtConfirmPassword").keyup(checkPasswordMatch);
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
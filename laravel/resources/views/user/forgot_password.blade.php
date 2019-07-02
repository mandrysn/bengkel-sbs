<?php $this->load->view('include/auth/header') ?>
<form class="form-signin" action="<?php echo base_url() ?>auth/forgot_password" method="POST">
	<h2 class="form-signin-heading"><?php echo lang('forgot_password_heading');?></h2>

	<?php if ($message!=''): ?>
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p><?php echo $message;?></p>
	</div>
	<?php endif ?>

	<label for="email" class="sr-only">Email</label>
	<input type="text" id="email" class="form-control" placeholder="Email" name="email" required autofocus>
	<p></p>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
</form>
<?php $this->load->view('include/auth/footer') ?>
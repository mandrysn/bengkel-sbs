<?php $this->load->view('include/auth/header') ?>
<form class="form-signin" action="<?php echo base_url() ?>auth/login" method="POST">
	<h2 class="form-signin-heading"><?php echo lang('login_heading');?></h2>

	<?php if ($message!=''): ?>
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p><?php echo $message;?></p>
	</div>
	<?php endif ?>

	<label for="identity" class="sr-only">Username</label>
	<input type="text" id="identity" class="form-control" placeholder="Email/Username" name="identity" required autofocus>
	<label for="password" class="sr-only">Password</label>
	<input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="remember" value="1"  id="remember" /> Remember me 
		</label>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
</form>
<?php $this->load->view('include/auth/footer') ?>
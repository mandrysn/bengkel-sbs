<?php $this->load->view('include/auth/header') ?>
<h1><?php echo lang('reset_password_heading');?></h1>

<?php if ($message!=''): ?>
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p><?php echo $message;?></p>
	</div>
	<?php endif ?>

<?php echo form_open('auth/reset_password/' . $code,'class="form-signin"');?>

	<p>
		<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
		<?php echo form_input($new_password,'','class="form-control"');?>
	</p>

	<p>
		<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
		<?php echo form_input($new_password_confirm,'','class="form-control"');?>
	</p>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>
	<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo form_submit('submit', lang('reset_password_submit_btn'));?></button>

<?php echo form_close();?>
<?php $this->load->view('include/auth/footer') ?>
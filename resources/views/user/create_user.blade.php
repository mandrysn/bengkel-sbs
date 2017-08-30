<?php $this->load->view('include/panel/header') ?>
<h1 class="page-header">
	<?php echo lang('create_user_heading');?> 
	<small><?php echo lang('create_user_subheading');?></small>
</h1>

<?php if ($message!=''): ?>
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p><?php echo $message;?></p>
	</div>
<?php endif ?>

<?php echo form_open("auth/create_user", 'class="form-horizontal"');?>

<div class="form-group">
	<?php echo lang('create_user_fname_label', 'first_name',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($first_name,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('create_user_lname_label', 'last_name',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($last_name,'','class="form-control"');?>
	</div>
</div>

<?php
if($identity_column!=='email') {
	echo '<p>';
	echo lang('create_user_identity_label', 'identity');
	echo '<br />';
	echo form_error('identity');
	echo form_input($identity);
	echo '</p>';
}
?>

<div class="form-group">
	<?php echo lang('create_user_company_label', 'company',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_dropdown('company',$company,'','class="form-control"'); ?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('create_user_email_label', 'email',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($email,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('create_user_phone_label', 'phone',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($phone,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('create_user_password_label', 'password',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($password,'','class="form-control"');?>
	</div>
</div>


<div class="form-group">
	<?php echo lang('create_user_password_confirm_label', 'password_confirm',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($password_confirm,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary"><?php echo lang('create_user_submit_btn') ?></button>
	</div>
</div>


<?php echo form_close();?>
<?php $this->load->view('include/panel/footer') ?>
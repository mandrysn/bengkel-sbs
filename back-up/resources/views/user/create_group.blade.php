<?php $this->load->view('include/panel/header') ?>
<h1 class="page-header">
	<?php echo lang('create_group_heading');?>
	<small><?php echo lang('create_group_subheading');?></small>
</h1>

<?php if ($message!=''): ?>
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p><?php echo $message;?></p>
	</div>
<?php endif ?>

<?php echo form_open("auth/create_group", 'class="form-horizontal"');?>

<div class="form-group">
	<?php echo lang('create_group_name_label', 'group_name',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($group_name,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('create_group_desc_label', 'description',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($description,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary"><?php echo lang('create_group_submit_btn') ?></button>
	</div>
</div>

<?php echo form_close();?>
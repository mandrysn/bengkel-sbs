<?php $this->load->view('include/panel/header') ?>
<h1 class="page-header">
	<?php echo lang('deactivate_heading');?> 
	<small><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></small>
</h1>

<?php echo form_open("auth/deactivate/".$user->id,"class='form-horizontal'");?>

<div class="form-group">
	<label class="col-lg-2 control-label"><?php echo lang('deactivate_heading');?></label>
	<div class="col-lg-10">
		<div class="radio">
			<label>
				
				<input type="radio" name="confirm" value="yes" checked="checked" /><?php echo lang('deactivate_confirm_y_label');?>
			</label>
		</div>
		<div class="radio">
			<label>
				
				<input type="radio" name="confirm" value="no" /><?php echo lang('deactivate_confirm_n_label');?>
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> <?php echo lang('deactivate_submit_btn') ?></button>
	</div>
</div>
<?php echo form_hidden($csrf); ?>
<?php echo form_hidden(array('id'=>$user->id)); ?>


<?php echo form_close();?>

<?php $this->load->view('include/panel/footer') ?>
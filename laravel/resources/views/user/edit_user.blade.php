<?php $this->load->view('include/panel/header') ?>
<h1 class="page-header">
	<?php echo lang('edit_user_heading');?> 
	<small><?php echo lang('edit_user_subheading');?></small>
</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string(), 'class="form-horizontal"');?>

<div class="form-group">
	<?php echo lang('edit_user_fname_label', 'first_name',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($first_name,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('edit_user_lname_label', 'last_name',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($last_name,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('edit_user_company_label', 'company',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_dropdown('company',$company,$company_selected,'class="form-control"'); ?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('edit_user_phone_label', 'phone',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($phone,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('edit_user_password_label', 'password',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($password,'','class="form-control"');?>
	</div>
</div>

<div class="form-group">
	<?php echo lang('edit_user_password_confirm_label', 'password_confirm',' class="col-lg-2 control-label"');?>
	<div class="col-lg-3">
		<?php echo form_input($password_confirm,'','class="form-control"');?>
	</div>
</div>
<?php if ($this->ion_auth->is_admin()): ?>
	<div class="form-group">
		<?php echo lang('edit_user_groups_heading', 'group',' class="col-lg-2 control-label"');?>
		<div class="col-lg-3">
			<?php foreach ($groups as $group):?>
				<div class="radio">
				<label class="checkbox">
					<?php
					$gID=$group['id'];
					$checked = null;
					$item = null;
					foreach($currentGroups as $grp) {
						if ($gID == $grp->id) {
							$checked= ' checked="checked"';
							break;
						}
					}
					?>
					<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
					<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
				</label>
				</div>
			<?php endforeach?>
		</div>
	</div>
<?php endif ?>
<?php echo form_hidden('id', $user->id);?>
<?php echo form_hidden($csrf); ?>
<div class="form-group">
	<div class="col-lg-10 col-lg-offset-2">
		<button type="submit" class="btn btn-primary"><?php echo lang('edit_user_submit_btn') ?></button>
	</div>
</div>

<?php echo form_close();?>
<?php $this->load->view('include/panel/footer') ?>
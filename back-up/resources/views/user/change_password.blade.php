
<h1 class="page-header">
      <?php echo lang('change_password_heading');?> 
</h1>


<?php echo form_open("auth/change_password", 'class="form-horizontal"');?>
<div class="form-group">
      <?php echo lang('change_password_old_password_label', 'old_password',' class="col-lg-2 control-label"');?>
      <div class="col-lg-3">
            <?php echo form_input($old_password,'','class="form-control"');?>
      </div>
</div>
<!--       <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
      </p> -->
<div class="form-group">
      <?php echo lang('change_password_new_password_label', $min_password_length,' class="col-lg-2 control-label"');?>
      <div class="col-lg-3">
            <?php echo form_input($new_password,'','class="form-control"');?>
      </div>
</div>
<!--       <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password);?>
      </p> -->
<div class="form-group">
      <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm',' class="col-lg-2 control-label"');?>
      <div class="col-lg-3">
            <?php echo form_input($new_password_confirm,'','class="form-control"');?>
      </div>
</div>
<!--       <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
      </p> -->

      <?php echo form_input($user_id);?>
      
<div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo lang('change_password_submit_btn') ?></button>
      </div>
</div>


<?php echo form_close();?>
<?php $this->load->view('include/panel/footer') ?>

<?php $this->load->view('include/panel/header') ?>
<h1 class="page-header">
	<?php echo lang('index_heading');?> 
	<small><?php echo lang('index_subheading');?></small>
</h1>

<?php if ($message!=''): ?>
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p><?php echo $message;?></p>
	</div>
<?php endif ?>

<?php echo anchor('auth/create_user', '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> '.lang('index_create_user_link'), "class='btn btn-primary'")?> 
<?php echo anchor('auth/create_group', '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> '.lang('index_create_group_link'), "class='btn btn-primary'")?>

<p></p>
<table class="table table-bordered table-hover">
	<thead>
	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id,  '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> '.lang('index_active_link'), "class='btn btn-success'") : anchor("auth/activate/". $user->id, '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> '.lang('index_inactive_link'), "class='btn btn-danger'");?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit', "class='btn btn-primary'") ;?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>
<?php $this->load->view('include/panel/footer') ?>
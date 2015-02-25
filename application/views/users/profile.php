<div class="row">
	<div class="col-sm-12">
		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<p>
	<strong>Jméno</strong>: <?php echo $user['name']; ?>
</p>
<p>
	<strong>Email</strong>: <?php echo $user['email']; ?>
</p>
<p>
	<strong>Oprávnění</strong>
	<?php
		$permissions = '';
		
		if ($user['can_publish'])
			$permissions .= 'publikovat, ';
		
		if ($user['can_approve'])
			$permissions .= 'schvalovat, ';
		
		if ($user['can_edit_users'])
			$permissions .= 'spravovat uživatele, ';
		
		if ($user['can_edit_settings'])
			$permissions .= 'spravovat stránku, ';
		
		if (strlen($permissions) > 0)
			$permissions = $permissions;
		
		echo $permissions;
	?>
</p>

<form class="form" role="form" action="" method="post">
	<div class="form-group">
		<label for="user_password">Změnit heslo</label>
		<input type="password" class="form-control" name="password" id="user_password" value="" placeholder="(nechat stejné)">
	</div>
	
	<div class="form-group">
		<label for="user_password">Zopakovat heslo</label>
		<input type="password" class="form-control" name="password2" id="user_password2" value="" placeholder="(nechat stejné)">
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Uložit</button>
		<a class="btn btn-default" href="<?php echo base_url('/users'); ?>" role="button">Zavřít</a>
	</div>
</form>
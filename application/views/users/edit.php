<div class="row">
	<div class="col-sm-12">
		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<form class="form" role="form" action="" method="post">
	<div class="form-group">
		<label for="user_name">Jméno</label>
		<input type="text" class="form-control" name="name" id="user_name"
			value="<?php echo set_value('name', $user['name']); ?>">
	</div>	
	
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="text" class="form-control" name="email" id="user_email"
			value="<?php echo set_value('email', $user['email']); ?>">
	</div>
	
	<div class="form-group">
		<label for="user_email">Oprávnění</label>
		
		<div class="checkbox">
			<label>
				<input type="checkbox" name="can_publish" value="1"
					<?php echo set_checkbox('can_publish', 1, ($user['can_publish'] == true));?>>
				Může publikovat
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="can_approve" value="1"
					<?php echo set_checkbox('can_approve', 1, ($user['can_approve'] == true));?>>
				Může schvalovat příspěvky ostatních
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="can_edit_users" value="1"
					<?php echo set_checkbox('can_edit_users', 1, ($user['can_edit_users'] == true));?>>
				Může spravovat uživatele
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="can_edit_settings" value="1"
					<?php echo set_checkbox('can_edit_settings', 1, ($user['can_edit_settings'] == true));?>>
				Může spravovat stránku
			</label>
		</div>
	</div>
	
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
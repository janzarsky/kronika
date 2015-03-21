<a class="btn btn-primary" href="<?php echo base_url('/users/add'); ?>" role="button">
	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	Přidat uživatele
</a>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Jméno</th>
			<th>Email</th>
			<th>Oprávnění</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td>
					<a href="<?php echo base_url('/users/edit/' . $user['id']); ?>">
						<?php echo $user['name']; ?>
					</a>
				</td>
				
				<td>
					<?php echo $user['email']; ?>
				</td>
				
				<td>
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
				</td>
				
				<td>
					<a href="<?php echo base_url('users/delete/' . $user['id']); ?>">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Odstranit
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
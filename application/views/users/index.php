<div class="row">
	<div class="col-sm-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Jméno</th>
					<th>Email</th>
					<th>Oprávnění</th>
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
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
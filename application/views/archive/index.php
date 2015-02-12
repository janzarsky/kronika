<div class="row">
	<div class="col-sm-6">
		<div class="btn-group" role="group">
			<a class="btn btn-primary" href="<?php echo base_url('/add'); ?>" role="button">Přidat událost</a>
		</div>
	</div>
	
	<div class="col-sm-6 text-right">
		<div class="btn-group btn-group-sm" role="group">
			<a class="btn <?php echo ($filter == '') ? 'btn-primary' : 'btn-default'; ?>"
				href="<?php echo base_url('/archive'); ?>" role="button">Všechny</a>
			<?php if ($can_approve): ?>
				<a class="btn <?php echo ($filter == 'user') ? 'btn-primary' : 'btn-default'; ?>"
					href="<?php echo base_url('/archive/user'); ?>" role="button">Moje</a>
			<?php endif; ?>
			<a class="btn <?php echo ($filter == 'published') ? 'btn-primary' : 'btn-default'; ?>"
				href="<?php echo base_url('/archive/published'); ?>" role="button">Publikované</a>
			<a class="btn <?php echo ($filter == 'sent-for-approval') ? 'btn-primary' : 'btn-default'; ?>"
				href="<?php echo base_url('/archive/sent-for-approval'); ?>" role="button">Ke schválení</a>
			<a class="btn <?php echo ($filter == 'drafts') ? 'btn-primary' : 'btn-default'; ?>"
				href="<?php echo base_url('/archive/drafts'); ?>" role="button">Návrhy</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Název</th>
					<th>Datum</th>
					
					<?php if (isset($events[0]['owner_name'])): ?>
						<th>Autor</th>
					<?php endif; ?>
					
					<th>Status</th>
					
					<?php if ($can_approve): ?>
						<th></th>
					<?php endif; ?>
					
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($events as $event): ?>
					<tr>
						<td>
							<a href="<?php echo base_url('/edit/' . $event['id']); ?>">
								<?php
									if ($event['title'])
										echo $event['title'];
									else
										echo '(Bez titulku)';
								?>
							</a>
						</td>
						
						<td>
							<?php echo $event['friendly_date']; ?>
						</td>
						
						<?php if (isset($event['owner_name'])): ?>
							<td><?php echo $event['owner_name']; ?></td>
						<?php endif; ?>
						
						<?php
							if ($event['sent_for_approval'])
								$cell_class = 'warning';
							else if ($event['published'])
								$cell_class = 'info';
							else
								$cell_class = 'danger';
						?>
						
						<td class="<?php echo $cell_class; ?>">
							<?php
								if ($event['published'])
									echo 'Publikováno';
								else if ($event['sent_for_approval'])
									echo 'Odesláno ke schválení';
								else
									echo 'Návrh';
							?>
						</td>
						
						<?php if ($can_approve): ?>
							<td>
								<?php if ($event['sent_for_approval']): ?>
									<a href="<?php echo base_url('edit/approve/' . $event['id']); ?>">
										Schválit
									</a> /
									<a href="<?php echo base_url('edit/reject/' . $event['id']); ?>">
										Zamítnout
									</a>
								<?php endif; ?>
							</td>
						<?php endif; ?>
						
						<td>
							<a href="<?php echo base_url('edit/delete/' . $event['id']); ?>">
								Odstranit
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
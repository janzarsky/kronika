<div class="row">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo base_url('/add'); ?>" role="button">Přidat událost</a>
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
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($events as $event): ?>
					<tr>
						<td>
							<a href="<?php echo base_url('/edit/' . $event['id']); ?>">
								<?php echo $event['title']; ?>
							</a>
						</td>
						
						<td>
							<?php echo $event['friendly_date']; ?>
						</td>
						
						<?php if (isset($event['owner_name'])): ?>
							<td><?php echo $event['owner_name']; ?></td>
						<?php endif; ?>
						
						<td>
							<?php
								if ($event['published'])
									echo 'Publikováno';
								else if ($event['sent_for_approval'])
									echo 'Odesláno ke schválení';
								else
									echo 'Návrh';
							?>
						</td>
						
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
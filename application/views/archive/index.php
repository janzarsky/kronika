<div class="row">
	<div class="col-sm-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Název</th>
					<th>Datum</th>
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
						<td><?php echo $event['date']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
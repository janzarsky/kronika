<section class="media">
	<div class="row">
		<form class="form form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
			<div class="col-md-7">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Náhled</th>
							<th>Popisek</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($medias as $media): ?>
							<tr>
								<td>
									<img src="<?php echo media_image($media['id'], 'thumb'); ?>" height="100">
								</td>
								<td></td>
								<td>
									<label>
										<input type="radio" class="" name="main" value="<?php echo $media['id']; ?>"
											<?php echo set_checkbox('main', '1', $media['main'] == 1); ?>> Titulní
									</label>
								</td>
								<td>
									<label>
										<input type="checkbox" class="" name="delete[]" value="<?php echo $media['id']; ?>"> Odstranit
									</label>
								</td>
							</tr>
						<?php endforeach; ?>
						
						<?php if (count($medias) == 0): ?>
						<td>Událost neobsahuje žádná média</td>
						<?php endif; ?>
					</tbody>
				</table>
				
				<button type="submit" class="btn btn-primary">Uložit</button>
				<a class="btn btn-default" href="<?php echo base_url('/edit/' . $event_id); ?>" role="button">Zpět</a>
			</div>
		</form>
	
		<form class="form form-horizontal" role="form" action="upload/<?php echo $event_id; ?>" method="post" enctype="multipart/form-data">
			<div class="col-md-5">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="event_url">Přidat</label>
					<div class="col-sm-8">
						<input type="file" class="form-control edit__file" name="files[]" id="event_file" multiple="multiple">
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary">Nahrát</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
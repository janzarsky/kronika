<form class="form form-horizontal" role="form" action="media/<?php echo $event_id; ?>" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-7 col-md-offset-5">
			<div class="row">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="event_url">Média</label>
					<div class="col-sm-8">
						<input type="file" class="form-control edit__file" name="userfile" id="event_file">
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary">Nahrát</button>
					</div>
				</div>
			</div>
			
			<div class="row">
				<?php foreach ($event['media'] as $media): ?>
					<div class="col-sm-4">
						<img src="<?php echo media_image($media['id'], 'thumb'); ?>" height="100">
						<label>
							<input type="checkbox" class="" name=""> Odstranit
						</label>
						<label>
							<input type="radio" class="" name="media_main" value="<?php echo $media['id']; ?>"
								<?php echo set_checkbox('media_main', '1', $media['main'] == 1); ?>> Titulní
						</label>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</form>
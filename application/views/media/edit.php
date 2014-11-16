<section class="media">
	<form class="form form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
		<?php foreach ($medias as $media): ?>
			<div class="row">
				<div class="col-sm-12">
					<img src="<?php echo media_image($media['id'], 'thumb'); ?>" height="100">
					<label>
						<input type="checkbox" class="" name="delete[]" value="<?php echo $media['id']; ?>"> Odstranit
					</label>
					<label>
						<input type="radio" class="" name="main" value="<?php echo $media['id']; ?>"
							<?php echo set_checkbox('main', '1', $media['main'] == 1); ?>> Titulní
					</label>
				</div>
			</div>
		<?php endforeach; ?>
		
		<div class="row">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary">Uložit</button>
			</div>
		</div>
	</form>
	
	<form class="form form-horizontal" role="form" action="upload/<?php echo $event_id; ?>" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-7">
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
			</div>
		</div>
	</form>
</section>
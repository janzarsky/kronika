<form class="form form-horizontal" role="form" action="media/<?php echo $event_id; ?>" method="post" enctype="multipart/form-data">
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
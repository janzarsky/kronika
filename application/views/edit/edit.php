<form class="form" role="form" action="<?php echo base_url('edit/submit'); ?>" method="post">
	<div class="row">
		<div class="col-sm-7 col-sm-push-5">
			<div class="form-group">
				<label class="sr-only" for="event_title">Titulek</label>
				<input type="text" class="form-control" name="title" id="event_title" placeholder="Titulek"
					value="<?php echo $event['title']; ?>">
			</div>
		</div>
		
		<div class="col-sm-5 col-sm-pull-7">
			<div class="form-group">
				<label class="sr-only" for="event_date">Datum</label>
				<input type="text" class="form-control" name="date" id="event_date" placeholder="Datum"
					value="<?php echo $event['date']; ?>">
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-5">
			<div class="form-group">
				<label class="sr-only" for="event_url">URL</label>
				<input type="text" class="form-control" name="url" id="event_url" placeholder="URL"
					value="<?php echo $event['url']; ?>">
			</div>
		</div>
		
		<div class="col-sm-7">
			<textarea class="form-control" name="text" rows="7"><?php echo $event['text']; ?></textarea>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-7 col-sm-offset-5">
			<div class="checkbox">
				<label>
					<?php if ($can_publish): ?>
						<input type="checkbox" name="publish"> Publikovat
					<?php else: ?>
						<input type="checkbox" name="send_for_approval"> Odeslat ke schválení
					<?php endif; ?>
				</label>
			</div>
			
			<button type="submit" class="btn btn-default">Uložit</button>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-sm-12">
		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<form class="form" role="form" action="" method="post">
	<div class="row">
		<div class="col-sm-7 col-sm-push-5">
			<div class="form-group">
				<label class="sr-only" for="event_title">Titulek</label>
				<input type="text" class="form-control" name="title" id="event_title" placeholder="Titulek"
					value="<?php echo set_value('title', $event['title']); ?>">
			</div>
		</div>
		
		<div class="col-sm-5 col-sm-pull-7">
			<div class="form-group">
				<label class="sr-only" for="event_date">Datum</label>
				<input type="text" class="form-control" name="date" id="event_date" placeholder="Datum"
					value="<?php echo set_value('date', $event['date']); ?>">
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-5">
			<div class="form-group">
				<label class="sr-only" for="event_url">URL</label>
				<input type="text" class="form-control" name="url" id="event_url" placeholder="URL"
					value="<?php echo set_value('url', $event['url']); ?>">
			</div>
		</div>
		
		<div class="col-sm-7">
			<textarea class="form-control" name="text" rows="7"><?php echo set_value('text', $event['text']); ?></textarea>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-7 col-sm-offset-5">
			<div class="checkbox">
				<label>
					<?php if ($can_publish): ?>
						<input type="checkbox" name="publish" value="1"
							<?php echo set_checkbox('publish', '1', $event['published'] == 1); ?>> Publikovat
					<?php else: ?>
						<input type="checkbox" name="send_for_approval" value="1"
							<?php echo set_checkbox('send_for_aproval', '1', $event['sent_for_approval'] == 1); ?>> Odeslat ke schválení
					<?php endif; ?>
				</label>
			</div>
			
			<button type="submit" class="btn btn-primary">Uložit</button>
			<a class="btn btn-default" href="<?php echo base_url('/archive'); ?>" role="button">Zavřít</a>
		</div>
	</div>
</form>
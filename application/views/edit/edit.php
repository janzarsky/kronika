<div class="row">
	<div class="col-sm-12">
		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<section class="edit">
	<form class="form form-horizontal" role="form" action="" method="post">
		<div class="row">
			<div class="col-sm-7 col-sm-push-5">
				<div class="form-group">
					<label class="sr-only" for="event_title">Titulek</label>
					<div class="col-sm-12">
						<input type="text" class="form-control edit__title" name="title" id="event_title" placeholder="Titulek"
							value="<?php echo set_value('title', $event['title']); ?>">
					</div>
				</div>	
				
				<textarea class="form-control edit__text" name="text" rows="7"><?php echo set_value('text', $event['text']); ?></textarea>
			</div>
			
			<div class="col-sm-5 col-sm-pull-7">
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="event_date">Datum</label>
						<div class="col-sm-10">
							<input type="text" class="form-control edit__date" name="date" id="event_date" placeholder="Datum"
								value="<?php echo set_value('date', $event['date']); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="event_url">URL</label>
						<div class="col-sm-10">
							<input type="text" class="form-control edit__url" name="url" id="event_url" placeholder="URL"
								value="<?php echo set_value('url', $event['url']); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-10 col-sm-offset-2">
						<div class="form-group">
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
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Uložit</button>
							<a class="btn btn-default" href="<?php echo base_url('/archive'); ?>" role="button">Zavřít</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form>
</section>
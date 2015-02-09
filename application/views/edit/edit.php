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
	<form class="form form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-7">
				<div class="form-group">
					<label class="sr-only" for="event_title">Titulek</label>
					<div class="col-sm-12">
						<input type="text" class="form-control edit__title" name="title" id="event_title" placeholder="Titulek"
							value="<?php echo set_value('title', $event['title']); ?>">
					</div>
				</div>	
				
				<div class="form-group">
					<div class="col-sm-12">
						<textarea class="form-control edit__text" name="text" rows="7" placeholder="Text (nepovinné)"
							><?php echo set_value('text', $event['text']); ?></textarea>
					</div>
				</div>
			</div>
			
			<div class="col-md-5">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="event_date">Datum</label>
					<div class="col-sm-10">
						<input type="text" class="form-control edit__date" name="date" id="event_date" placeholder="Datum"
							value="<?php echo set_value('date', $event['friendly_date']); ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="event_importance">Důležitost</label>
					<div class="col-sm-10">
						<select class="form-control" name="importance" id="event_importance" >
							<option value="1" <?php echo set_select('importance', '1', $event['importance'] == 1); ?>>
								Vysoká - významné události, tábory
							</option>
							<option value="2" <?php echo set_select('importance', '2', $event['importance'] == 2); ?>>
								Střední - chaty, vánoční schůzky
							</option>
							<option value="3" <?php echo set_select('importance', '3', $event['importance'] == 3); ?>>
								Nízká - výpravy, schůzky
							</option>
						</select>
					</div>
				</div>
				
				<?php if ($event['id'] != 0): ?>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="event_url">URL</label>
						<div class="col-sm-10">
							<input type="text" class="form-control edit__url" name="url" id="event_url" placeholder="(nepovinné)"
								value="<?php echo set_value('url', $event['url']); ?>">
						</div>
					</div>
				<?php else: ?>
					<input type="hidden" name="url" id="event_url" value="<?php echo set_value('url', $event['url']); ?>">
				<?php endif; ?>
				
				<?php if ($event['id'] != 0): ?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Média</label>
						<div class="col-sm-10">
							<a class="btn btn-primary" href="<?php echo base_url('/media/' . $event['id']); ?>" role="button">
								Spravovat média (<?php echo $media_count; ?>)
							</a>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-2">
						<?php if ($is_owner || $event['sent_for_approval'] == false): ?>
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
						<?php else: ?>
							<a href="<?php echo base_url('edit/approve/' . $event['id']); ?>">
								Schválit
							</a> /
							<a href="<?php echo base_url('edit/reject/' . $event['id']); ?>">
								Zamítnout
							</a>
						<?php endif; ?>
					</div>
					<?php if ($event['id'] != 0): ?>
						<div class="col-sm-5">
							<a href="<?php echo base_url('edit/delete/' . $event['id']); ?>">
								Odstranit
							</a>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Uložit</button>
						<a class="btn btn-default" href="<?php echo base_url('/archive'); ?>" role="button">Zavřít</a>
					</div>
				</div>
			</div>
		</div>

	</form>
</section>
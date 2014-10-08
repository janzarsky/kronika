<div class="event__media">
	<?php foreach ($media as $m): ?>
		<?php if ($m['type'] == 0): ?>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="event__mediaItem">
						<img src="<?php echo media_image($m['id']); ?>" alt="$m['title']" title="<?php echo $m['title']; ?>" />
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-7 col-sm-offset-5">
					<div class="event__mediaTitle">
						<?php echo $m['title']; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
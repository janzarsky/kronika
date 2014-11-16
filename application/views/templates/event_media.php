<div class="event__media">
	<?php foreach ($media as $m): ?>
		<?php if ($m['type'] == 0): ?>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="event__mediaItem">
						<img srcset="<?php echo media_image($m['id'], 1080); ?> 1620w,
												 <?php echo media_image($m['id'], 768); ?> 1152w,
												 <?php echo media_image($m['id'], 420); ?> 630w,
												 <?php echo media_image($m['id'], 210); ?> 315w"
							sizes="100vw"
							src="<?php echo media_image($m['id'], 1080); ?>"
							alt="<?php echo (isset($m['title'])) ? $m['title'] : 'Fotka č. ' . $m['id']; ?>"
							title="<?php echo (isset($m['title'])) ? $m['title'] : ''; ?>" />
					</div>
				</div>
			</div>
			
			<?php if (isset($media['title'])): ?>
				<div class="row">
					<div class="col-sm-7 col-sm-offset-5">
						<div class="event__mediaTitle">
							<?php echo $m['title']; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
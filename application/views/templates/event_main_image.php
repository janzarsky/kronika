<?php if ($image_type == 'important'): ?>
	<div class="event__main-image event__main-image--important">
		<a href="<?php echo base_url('detail/' . $event['url']); ?>">
			<img srcset="<?php echo media_image($event['main_image_id'], 1080); ?> 1620w,
								 <?php echo media_image($event['main_image_id'], 768); ?> 1152w,
								 <?php echo media_image($event['main_image_id'], 420); ?> 630w,
								 <?php echo media_image($event['main_image_id'], 210); ?> 315w"
				sizes="58vw"
				src="<?php echo media_image($event['main_image_id'], 768); ?>"
				alt="" />
		</a>
	</div>
<?php else: ?>
	<div class="event__main-image <?php echo ($image_type == 'left') ? 'event__main-image--left' : 'event__main-image--noText'; ?>">
		<a href="<?php echo base_url('detail/' . $event['url']); ?>">
			<img srcset="<?php echo media_image($event['main_image_id'], 210); ?> 1x,
									 <?php echo media_image($event['main_image_id'], 420); ?> 2x"
				src="<?php echo media_image($event['main_image_id'], 210); ?>"
				alt="" />
		</a>
	</div>
<?php endif; ?>
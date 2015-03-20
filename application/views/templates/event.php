<section class="event event--preview event--width1 event--imp<?php echo $event['importance']; ?>
								<?php echo ($event['importance'] == 1) ? 'layoutSeparator' : ''; ?>">
	<div class="event__widthContainer">
		<?php if (isset($event['main_image_id'])): ?>
			<?php if ($event['importance'] == 1): ?>
				<div class="event__mainImage">
					<a href="<?php echo base_url('detail/' . $event['url']); ?>">
						<img srcset="<?php echo media_image($event['main_image_id'], 960); ?> 960w,
												 <?php echo media_image($event['main_image_id'], 640); ?> 640w,
												 <?php echo media_image($event['main_image_id'], 320); ?> 320w"
							sizes="(min-width: 768px) 50vw,
										 (min-width: 528px) 528px,
										 100vw"
							src="<?php echo media_image($event['main_image_id'], 768); ?>"
							alt="" />
					</a>
				</div>
			<?php else: ?>
				<div class="event__mainImage">
					<a href="<?php echo base_url('detail/' . $event['url']); ?>">
						<img srcset="<?php echo media_image($event['main_image_id'], 960); ?> 960w,
												 <?php echo media_image($event['main_image_id'], 640); ?> 640w,
												 <?php echo media_image($event['main_image_id'], 320); ?> 320w"
							sizes="(min-width: 1200px) 25vw,
										 (min-width: 992px) 33vw,
										 (min-width: 768px) 50vw,
										 (min-width: 528px) 528px,
										 100vw"
							src="<?php echo media_image($event['main_image_id'], 768); ?>"
							alt="" />
					</a>
				</div>
			<?php endif; ?>
		<?php else: ?>
			<div class="event__mainImage">
					<a href="<?php echo base_url('detail/' . $event['url']); ?>">
						<img src="<?php echo blank_media_image(); ?>"
							alt="" />
					</a>
				</div>
		<?php endif; ?>
		
		<header class="event__header">
			<?php	if(isset($event['title'])): ?>
				<h2 class="event__title">
					<a href="<?php echo base_url('detail/' . $event['url']); ?>">
						<?php echo $event['title']; ?>
					</a>
				</h2>
			<?php endif; ?>
			
			<?php	if(isset($event['friendly_date'])): ?>
				<div class="event__date">
					<?php echo $event['friendly_date']; ?>
				</div>
			<?php endif; ?>
			
			<?php	if(isset($event['text']) && $event['importance'] == 1): ?>
				<div class="event__text">
					<?php echo $event['text']; ?>
				</div>
			<?php endif; ?>
		</header>
	</div>
</section>
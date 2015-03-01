<section class="event event--detail event--imp<?php echo $event['importance']; ?>">
	<div class="event__widthContainer">
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
		</header>
		
		<div class="event__gallery">
			<?php $counter = 0; ?>
			<?php foreach ($event['media'] as $media): ?>
				<div class="event__image">
					<img srcset="<?php echo media_image($media['id'], 1080); ?> 1620w,
										 <?php echo media_image($media['id'], 768); ?> 1152w,
										 <?php echo media_image($media['id'], 420); ?> 630w,
										 <?php echo media_image($media['id'], 210); ?> 315w"
						sizes="(min-width: 992px) 50vw,
									 (min-width: 1200px) 33vw,
									 100vw"
						src="<?php echo media_image($media['id'], 768); ?>"
						alt="" />
				</div>
				
				<?php $counter++; ?>
				
				<?php if ($counter%2 == 0): ?>
					<div class="clearfix visible-md-block"></div>
				<?php endif; ?>
				<?php if ($counter%3 == 0): ?>
					<div class="clearfix visible-lg-block"></div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
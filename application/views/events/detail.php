<section class="event event--nojs event--detail event--imp<?php echo $event['importance']; ?>">
	<div class="event__widthContainer">
		<header class="event__header">
			<?php	if(isset($event['title'])): ?>
				<h2 class="event__title">
					<?php echo $event['title']; ?>
				</h2>
			<?php endif; ?>
			
			<?php	if(isset($event['friendly_date'])): ?>
				<div class="event__date">
					<?php echo $event['friendly_date']; ?>
				</div>
			<?php endif; ?>
			
			<?php	if(isset($event['text'])): ?>
				<div class="event__text">
					<?php echo $event['text']; ?>
				</div>
			<?php endif; ?>
		</header>
	</div>
	
	<div class="event__gallery <?php echo (count($event['media']) == 1) ? 'event__gallery--singleImage' : ''; ?>">
		<div class="event__galleryRow">
			<div class="event__navigation event__navigation--left">
				<div class="event__navigationArrow">
					<button><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button>
				</div>
			</div>
			
			<div class="event__galleryWrapper">
				<?php $counter = 0; ?>
				<?php foreach ($event['media'] as $media): ?>
					<figure class="event__image <?php if ($counter == 0) echo 'event__image--active'; ?>">
						<img srcset="<?php echo media_image($media['id'], 1600); ?> 1600w,
												 <?php echo media_image($media['id'], 1200); ?> 1200w,
												 <?php echo media_image($media['id'], 960); ?> 960w,
												 <?php echo media_image($media['id'], 640); ?> 640w,
												 <?php echo media_image($media['id'], 320); ?> 320w"
							sizes="(min-width: 768px) 83vw,
										 (min-width: 528px) 528px,
										 100vw"
							src="<?php echo media_image($media['id'], 960); ?>"
							alt="" />
						
						<?php	if(isset($media['text']) && $media['text'] != ''): ?>
							<figcaption class="event__imageText">
								<?php echo $media['text']; ?>
							</figcaption>
						<?php endif; ?>
					</figure>
					
					<?php $counter++; ?>
					
					<?php if ($counter%2 == 0): ?>
						<div class="clearfix visible-md-block"></div>
					<?php endif; ?>
					<?php if ($counter%3 == 0): ?>
						<div class="clearfix visible-lg-block"></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			
			<div class="event__navigation event__navigation--right">
				<div class="event__navigationArrow">
					<button><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
				</div>
			</div>
		</div>
	</div>
</section>
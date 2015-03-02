<section class="event event--preview event--imp<?php echo $event['importance']; ?>">
	<div class="event__widthContainer">
		<?php if (isset($event['main_image_id'])): ?>
			<div class="event__mainImage">
				<a href="<?php echo base_url('detail/' . $event['url']); ?>">
					<img srcset="<?php echo media_image($event['main_image_id'], 960); ?> 960w,
											 <?php echo media_image($event['main_image_id'], 640); ?> 640w,
											 <?php echo media_image($event['main_image_id'], 320); ?> 320w"
						sizes="(min-width: 992px) 33vw,
									 (min-width: 768px) 50vw,
									 (min-width: 528px) 528px,
									 100vw"
						src="<?php echo media_image($event['main_image_id'], 768); ?>"
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
		</header>
	</div>
</section>
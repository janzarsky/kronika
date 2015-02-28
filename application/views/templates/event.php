<section class="event">
	<div class="event__widthContainer">
		<?php if (isset($event['main_image_id'])): ?>
			<div class="event__mainImage">
				<a href="<?php echo base_url('detail/' . $event['url']); ?>">
					<img srcset="<?php echo media_image($event['main_image_id'], 210); ?> 1x,
											 <?php echo media_image($event['main_image_id'], 420); ?> 2x"
						src="<?php echo media_image($event['main_image_id'], 210); ?>"
						alt="" />
				</a>
			</div>
		<?php endif; ?>
		
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
	</div>
</section>
<section class="event">
	<div class="row">
		<div class="col-sm-7 col-sm-push-5">
			<header class="event__title">
				<a href="<?php echo base_url('detail/' . $event['url']); ?>">
					<?php echo $event['title']; ?>
				</a>
			</header>
		</div>
		
		<div class="col-sm-5 col-sm-pull-7">
			<header class="event__date">
				<?php if(isset($event['friendly_date']) && $event['friendly_date'] != null):
					echo $event['friendly_date'];
				endif; ?>
			</header>
		</div>
	</div>
	
	<?php
		if(isset($event['media']))
			$this->load->view('templates/event_media', array('media' => $event['media']));
	?>
		
	<div class="row">
		<div class="col-sm-5">
			<?php if(isset($event['main_image_id']) && isset($event['media']) == false): ?>
				<div class="event__main-image">
					<a href="<?php echo base_url('detail/' . $event['url']); ?>">
						<img srcset="<?php echo media_image($event['main_image_id'], 210); ?> 1x,
												 <?php echo media_image($event['main_image_id'], 420); ?> 2x"
							src="<?php echo media_image($event['main_image_id'], 210); ?>"
							alt="" />
					</a>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="col-sm-7">
			<p class="event__text">
				<?php echo $event['text']; ?>
			</p>
		</div>
	</div>
</section>
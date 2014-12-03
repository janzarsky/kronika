<section class="event">
	<div class="row event__detail">
		<div class="col-sm-7">
			<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => 'large'), true); ?>
		</div>
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-12">
					<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
				</div>
				<div class="col-sm-12">
					<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
				</div>
				<div class="col-sm-12">
					<p class="event__text">
						<?php echo $event['text']; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<?php foreach ($event['media'] as $media): ?>
			<div class="col-sm-6 col-md-4 col-md-3">
				<div class="event__image">
					<img srcset="<?php echo media_image($media['id'], 1080); ?> 1620w,
										 <?php echo media_image($media['id'], 768); ?> 1152w,
										 <?php echo media_image($media['id'], 420); ?> 630w,
										 <?php echo media_image($media['id'], 210); ?> 315w"
						sizes="(min-width: 768px) 50vw,
									 (min-width: 992px) 33vw,
									 (min-width: 1200px) 25vw,
									 100vw"
						src="<?php echo media_image($media['id'], 768); ?>"
						alt="" />
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
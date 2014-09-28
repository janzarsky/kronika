<section class="event">
	<div class="row">
		<div class="col-md-5">
			<header class="event__date">
				<?php if(isset($event['friendly_date']) && $event['friendly_date'] != null):
					echo $event['friendly_date'];
				endif; ?>
			</header>
		</div>
		
		<div class="col-md-7">
			<header class="event__title">
				<a href="<?php echo base_url('detail/' . $event['url']); ?>">
					<?php echo $event['title']; ?>
				</a>
			</header>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php if(isset($event['media']) && $event['media'] != null): ?>
				<?php $this->load->view('templates/event_media', array('media' => $event['media'], 'hidden' => $hidden_media)); ?>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-5">
			<?php if($hidden_media === true && isset($event['main_image']) && $event['main_image'] != null): ?>
				<div class="event__main-image">
					<a href="<?php echo base_url('detail/' . $event['url']); ?>">
						<img src="<?php echo media_image($event['main_image']['id']); ?>" alt="" />
					</a>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="col-md-7">
			<p class="event__text">
				<?php echo $event['text']; ?>
			</p>
		</div>
	</div>
</section>
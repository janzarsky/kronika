<section class="event">
	<header class="event__title">
		<a href="<?php echo base_url('detail/' . $event['url']); ?>">
			<?php echo $event['title']; ?>
		</a>
	</header>
	
	<?php if(isset($event['media']) && $event['media'] != null): ?>
		<?php $this->load->view('templates/event_media', array('media' => $event['media'])); ?>
	<?php elseif(isset($event['main_image']) && $event['main_image'] != null): ?>
		<div class="event__main-image">
			<a href="<?php echo base_url('detail/' . $event['url']); ?>">
				<img src="<?php echo media_image($event['main_image']['id']); ?>" alt="" />
			</a>
		</div>
	<?php endif; ?>
	
	<p class="event__text">
		<?php echo $event['text']; ?>
	</p>
	
	<footer class="event__date">
		<?php echo $event['date']; ?>
	</footer>
</section>
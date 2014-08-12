<section class="event">
	<header class="event__title">
		<a href="<?php echo base_url('detail/' . $event['url']); ?>">
			<?php echo $event['title']; ?>
		</a>
	</header>
	
	<div class="event__media">
		<ul class="rslides">
			<?php foreach ($event['images'] as $image): ?>
				<li><img src="<?php echo media_image($image['id']); ?>" alt="" /></li>
			<?php endforeach; ?>
		</ul>
	</div>
	
	<p class="event__text">
		<?php echo $event['text']; ?>
	</p>
	
	<footer class="event__date">
		<?php echo $event['date']; ?>
	</footer>
</section>
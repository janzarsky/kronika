<?php foreach ($events as $event) : ?>
	<?php if (isset($event['year_header'])): ?>
		<header class="dateHeader--year">
			<?php echo $event['year_header']; ?>
		</header>
	<?php endif; ?>
	<?php if (isset($event['month_header'])): ?>
		<header class="dateHeader--month">
			<?php echo $event['month_header']; ?>
		</header>
	<?php endif; ?>
	
	<section class="event">
		<header class="event__title">
			<?php echo $event['title']; ?>
		</header>
		
		<p class="event__text">
			<?php echo $event['text']; ?>
		</p>
		
		<footer class="event__date">
			<?php echo $event['date']; ?>
		</footer>
	</section>
<?php endforeach; ?>
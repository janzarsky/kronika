<?php foreach ($events as $event) : ?>
	<?php if (isset($event['year_header'])): ?>
		<div class="row">
			<div class="col-md-12">
				<header class="dateHeader--year">
					<?php echo $event['year_header']; ?>
				</header>
			</div>
		</div>
	<?php endif; ?>
	
	<?php if (isset($event['month_header'])): ?>
		<div class="row">
			<div class="col-md-12">
				<header class="dateHeader--month">
					<?php echo $event['month_header']; ?>
				</header>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="row">
		<div class="col-md-12">
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
		</div>
	</div>
<?php endforeach; ?>
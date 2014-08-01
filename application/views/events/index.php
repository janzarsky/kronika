<?php foreach ($events as $event) : ?>
	<?php if (isset($event['year_header'])): ?>
		<header>
			<?php echo $event['year_header']; ?>
		</header>
	<?php endif; ?>
	<?php if (isset($event['month_header'])): ?>
		<header>
			<?php echo $event['month_header']; ?>
		</header>
	<?php endif; ?>
	
	<section>
		<header><?php echo $event['title']; ?></header>
		<?php echo $event['text']; ?>
		<footer><?php echo $event['date']; ?></footer>
	</section>
<?php endforeach; ?>
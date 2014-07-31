<?php foreach ($events as $event) : ?>
	<section>
		<header><?php echo $event['title']; ?></header>
		<?php echo $event['text']; ?>
		<footer><?php echo $event['date']; ?></footer>
	</section>
<?php endforeach; ?>
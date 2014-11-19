<header class="event__title <?php echo (isset($type)) ? 'event__title--' . $type : ''; ?>">
	<a href="<?php echo base_url('detail/' . $event['url']); ?>">
		<?php echo $event['title']; ?>
	</a>
</header>
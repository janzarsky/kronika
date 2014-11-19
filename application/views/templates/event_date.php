<header class="event__date <?php echo (isset($type)) ? 'event__date--' . $type : ''; ?>">
	<?php if(isset($event['friendly_date']) && $event['friendly_date'] != null):
		echo $event['friendly_date'];
	endif; ?>
</header>
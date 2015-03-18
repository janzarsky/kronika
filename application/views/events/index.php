<?php if (isset($next_url)): ?>
	<div class="loader loader--top">
		&#8593;
		<a href="<?php echo base_url($next_url); ?>">
			Načíst předchozí události
		</a>
	</div>
<?php endif; ?>

<main class="eventsContainer">
	<?php foreach ($events as $event) : ?>
		<?php $this->load->view('templates/event', array('event' => $event)); ?>
	<?php endforeach; ?>
</main>

<?php if (isset($prev_url)): ?>
	<div class="loader loader--bottom">
		&#8595;
		<a href="<?php echo base_url($prev_url); ?>">
			Načíst další události
		</a>
	</div>
<?php endif; ?>
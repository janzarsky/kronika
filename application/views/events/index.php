<?php if (isset($next_url)): ?>
	<div class="loader loader--top">
		&#8593;
		<a href="<?php echo base_url($next_url); ?>">
			Více do budoucnosti
		</a>
	</div>
<?php endif; ?>

<main class="eventsContainer">
	<?php $prev_year = 0; ?>
	<?php foreach ($events as $event) : ?>
		<?php if ($prev_year != 0 && $event['scout_year'] != $prev_year): ?>
			<h2 class="separator layoutSeparator">
				Oddílový rok <?php echo $event['scout_year']; ?>/<?php echo $event['scout_year'] + 1; ?>
			</h2>
		<?php endif; ?>
		
		<?php $this->load->view('templates/event', array('event' => $event)); ?>
		
		<?php $prev_year = $event['scout_year']; ?>
	<?php endforeach; ?>
</main>

<?php if (isset($prev_url)): ?>
	<div class="loader loader--bottom">
		&#8595;
		<a href="<?php echo base_url($prev_url); ?>">
			Více do minulosti
		</a>
	</div>
<?php endif; ?>
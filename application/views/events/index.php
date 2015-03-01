<?php if (isset($next_url)): ?>
	<div class="row">
		<div class="col-sm-7 col-sm-offset-5">
			<div class="loader loader--top">
				&#8593;
				<a href="<?php echo base_url($next_url); ?>">
					Načíst předchozí události
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>

<main class="eventsContainer">
	<?php $counter = 0; ?>
	<?php foreach ($events as $event) : ?>
		<?php $this->load->view('templates/event', array('event' => $event)); ?>
		
		<?php $counter++; ?>
		
		<?php if ($counter%2 == 0): ?>
			<div class="clearfix visible-sm-block"></div>
		<?php endif; ?>
		<?php if ($counter%3 == 0): ?>
			<div class="clearfix visible-md-block"></div>
		<?php endif; ?>
		<?php if ($counter%4 == 0): ?>
			<div class="clearfix visible-lg-block"></div>
		<?php endif; ?>
	<?php endforeach; ?>
</main>

<?php if (isset($prev_url)): ?>
	<div class="row">
		<div class="col-sm-7 col-sm-offset-5">
			<div class="loader loader--bottom">
				&#8595;
				<a href="<?php echo base_url($prev_url); ?>">
					Načíst další události
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>
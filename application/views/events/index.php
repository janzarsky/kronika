<?php foreach ($events as $event) : ?>
	<?php $this->load->view('templates/event', array('event' => $event)); ?>
<?php endforeach; ?>

<div class="row">
	<div class="col-sm-7 col-sm-offset-5">
		<div class="loader loader--bottom">
			&#8595;
			<a href="<?php echo base_url($prev_url); ?>">
				Načíst další příspěvky
			</a>
		</div>
	</div>
</div>
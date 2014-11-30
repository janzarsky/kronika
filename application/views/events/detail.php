<section class="event">
	<div class="row">
		<div class="col-sm-7">
			<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => 'large'), true); ?>
		</div>
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-12">
					<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
				</div>
				<div class="col-sm-12">
					<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
				</div>
				<div class="col-sm-12">
					<p class="event__text">
						<?php echo $event['text']; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="event">
	<?php
		$importance = $event['importance'];
		$has_image = isset($event['main_image_id']);
		$has_text = $event['text'] != '';
	?>
	
	<?php if ($importance == 3 ||
						($importance == 2 && $has_image == false) ||
						($importance == 1 && $has_image == false)): ?>
		<div class="row">
			<div class="col-sm-5 col-sm-offset-7">
				<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
			</div>
			
			<div class="col-sm-5 col-sm-offset-7">
				<?php echo $this->load->view('templates/event_date.php', array('type' => 'right'), true); ?>
			</div>
		</div>
	<?php elseif ($importance == 2): ?>
		<div class="row">
			<div class="col-sm-7">
				<?php if (isset($event['main_image_id'])): ?>
					<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => null), true); ?>
				<?php else: ?>
					<p class="event__text">
						<?php echo $event['text']; ?>
					</p>
				<?php endif; ?>
			</div>
			<div class="col-sm-5">
				<div class="row">
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
					</div>
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
					</div>
					
				</div>
			</div>
		</div>
	<?php elseif ($importance == 1): ?>
		<div class="row">
			<div class="col-sm-9">
				<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => 'large'), true); ?>
			</div>
			<div class="col-sm-3">
				<div class="row">
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
					</div>
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
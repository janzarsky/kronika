<section class="event">
	<?php
		$importance = $event['importance'];
		$has_image = isset($event['main_image_id']);
		$has_text = $event['text'] != '';
	?>
	
	<?php if ($importance == 3 ||
						($importance == 2 && $has_image == false) ||
						($importance == 1 && $has_image == false && $has_text == false)): ?>
		<div class="row">
			<div class="col-sm-7 col-sm-push-5">
				<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
			</div>
			
			<div class="col-sm-5 col-sm-pull-7">
				<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
			</div>
		</div>
	<?php elseif ($importance == 2): ?>
		<div class="row">
			<div class="col-sm-5">
				<div class="row">
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_title.php', array('type' => 'left'), true); ?>
					</div>
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
					</div>
					
				</div>
			</div>
			<div class="col-sm-7">
				<?php if (isset($event['main_image_id'])): ?>
					<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => 'left'), true); ?>
				<?php else: ?>
					<p class="event__text">
						<?php echo $event['text']; ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	<?php elseif ($importance == 1): ?>
		<div class="row">
			<div class="col-sm-5">
				<div class="row">
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_title.php', array('type' => 'important'), true); ?>
					</div>
					<div class="col-sm-12">
						<?php echo $this->load->view('templates/event_date.php', array('type' => 'important'), true); ?>
					</div>
					<div class="col-sm-12">
						<p class="event__text event__text--important">
							<?php echo $event['text']; ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-7">
				<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => 'important'), true); ?>
			</div>
		</div>
	<?php endif; ?>
</section>
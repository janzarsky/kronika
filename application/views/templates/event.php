<section class="event">
	<?php if ($event['importance'] == 1 && isset($event['main_image_id'])): ?>
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
	<?php elseif ($event['importance'] == 2): ?>
		<?php if (isset($event['main_image_id']) && $event['text'] != ''): ?>
			<div class="row">
				<div class="col-sm-7 col-sm-push-5">
					<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
				</div>
				
				<div class="col-sm-5 col-sm-pull-7">
					<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-5">
					<?php echo $this->load->view('templates/event_main_image.php', array('image_type' => ''), true); ?>
				</div>
				
				<div class="col-sm-7">
					<p class="event__text">
						<?php echo $event['text']; ?>
					</p>
				</div>
			</div>
		<?php else: ?>
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
		<?php endif; ?>
	<?php elseif ($event['importance'] == 3): ?>
		<div class="row">
			<div class="col-sm-7 col-sm-push-5">
				<?php echo $this->load->view('templates/event_title.php', array('type' => null), true); ?>
			</div>
			
			<div class="col-sm-5 col-sm-pull-7">
				<?php echo $this->load->view('templates/event_date.php', array('type' => null), true); ?>
			</div>
		</div>
	<?php endif; ?>
</section>
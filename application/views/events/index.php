<?php foreach ($events as $event) : ?>
	<div class="row">
		<div class="col-sm-2 col-sm-offset-1 col-md-offset-2">
			<?php if (isset($event['year_header'])): ?>
				<div class="row">
					<div class="col-sm-12">
						<header class="dateHeader dateHeader--year">
							<?php echo $event['year_header']; ?>
						</header>
					</div>
				</div>
			<?php endif; ?>
		
			<?php if (isset($event['month_header'])): ?>
				<div class="row">
					<div class="col-sm-12">
						<header class="dateHeader dateHeader--month">
							<?php echo $event['month_header']; ?>
						</header>
					</div>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="col-sm-8 col-md-6">
			<?php $this->load->view('templates/event', array('event' => $event)); ?>
		</div>
	</div>
<?php endforeach; ?>
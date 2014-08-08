<div class="row">
	<div class="nav-parent col-sm-2">
		<nav class="nav">
			<div class="panel-group" id="accordion">
				<?php
					$first_year = (isset($first_year)) ? $first_year : 1907;
					$last_year = (isset($last_year)) ? $last_year : date("Y");
					
					$first_decade = floor($first_year/10)*10;
					$last_decade = floor($last_year/10)*10;
				?>
				
				<?php for($decade = $first_decade; $decade <= $last_decade; $decade += 10): ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#decade<?php echo $decade; ?>">
									<?php echo $decade; ?>
								</a>
							</h4>
						</div>
						<div id="decade<?php echo $decade; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav nav-pills">
									<?php for($year = $decade; $year < $decade + 10; $year++): ?>
										<li><a href="#"><?php echo $year; ?></a></li>
									<?php endfor; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		</nav>
	</div>
</div>
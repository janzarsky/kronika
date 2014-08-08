<nav class="navbar">
	<div class="panel-group" id="accordion">
		<?php
			$first_year = (isset($first_year)) ? $first_year : 1907;
			$last_year = (isset($last_year)) ? $last_year : date("Y");
			
			$first_decade = floor($first_year/10)*10;
			$last_decade = floor($last_year/10)*10;
			
			$active_year = (isset($active_year)) ? $active_year : $last_year;
		?>
		
		<?php for($decade = $last_decade; $decade >= $first_decade; $decade -= 10): ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#decade<?php echo $decade; ?>">
							<?php echo substr($decade, 2, 2) . '\''; ?>
						</a>
					</h4>
				</div>
				
				<?php $collapse_in = (($active_year - $decade) < 10 && ($active_year - $decade) >= 0) ? "in" : ""; ?>
				
				<div id="decade<?php echo $decade; ?>" class="panel-collapse collapse <?php echo $collapse_in; ?>">
					<div class="panel-body">
						<ul class="nav nav-pills">
							<?php for($year = $decade + 9; $year >= $decade; $year--): ?>
								<?php if ($year == $active_year): ?>
									<li class="active">
								<?php else: ?>
									<li>
								<?php endif; ?>
										<a href="<?php echo $year; ?>"><?php echo $year; ?></a>
									</li>
							<?php endfor; ?>
						</ul>
					</div>
				</div>
			</div>
		<?php endfor; ?>
	</div>
</nav>
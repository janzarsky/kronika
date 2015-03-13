<div class="row">
	<div class="col-sm-5">
		<header class="pageHeader">
			<a href="<?php echo base_url(); ?>">
				Kronika
			</a>
		</header>
	</div>
	<div class="col-sm-7">
		<nav class="pageNav pageNav--nojs">
			<?php
				$first_year = (isset($first_year)) ? $first_year : 1907;
				$last_year = (isset($last_year)) ? $last_year : date("Y");
				
				$active_year = (isset($active_year)) ? $active_year : $last_year;
				
				$start_year = $active_year - 3;
				$end_year = $active_year + 3;
				
				if ($start_year < $first_year)
					$start_year = $first_year;
				
				if ($end_year > $last_year)
					$end_year = $last_year;
			?>
			
			<div class="pageNav__more pageNav__more--hidden">
				<?php for ($year = ($first_year - $first_year%10); $year <= $last_year; $year += 10): ?>
					<a class="pageNav__year" href="<?php echo base_url($year); ?>">
						<?php echo $year; ?>
					</a>
				<?php endfor; ?>
			</div>
			
			<?php for ($year = $start_year; $year < $active_year; $year++): ?>
				<?php
					if ($active_year - $year > 2)
						$additional_class = 'pageNav__year--additional';
					else
						$additional_class = '';
				?>
				
				<a class="pageNav__year <?php echo $additional_class; ?>" href="<?php echo base_url($year); ?>">
					<?php echo $year; ?>
				</a>
			<?php endfor; ?>
			
			<a class="pageNav__year pageNav__year--active" href="<?php echo base_url($active_year); ?>"><?php echo $active_year; ?></a>
			
			<?php for ($year = $active_year + 1; $year <= $end_year; $year++): ?>
				<?php
					if ($year - $active_year > 2)
						$additional_class = 'pageNav__year--additional';
					else
						$additional_class = '';
				?>
				
				<a class="pageNav__year <?php echo $additional_class; ?>" href="<?php echo base_url($year); ?>">
					<?php echo $year; ?>
				</a>
			<?php endfor; ?>
			
			<button class="pageNav__toggleMore">více</button>
		</nav>
	</div>
</div>
<header class="header  header--nojs">
	<h1 class="header__title">
		<a href="<?php echo base_url(); ?>">
			Kronika
		</a>
	</h1>
	<nav class="header__nav">
		<?php
			$first_year = (isset($first_year)) ? $first_year : 1907;
			$last_year = (isset($last_year)) ? $last_year : date("Y");
			
			$active_year = (isset($active_year)) ? $active_year : $last_year;
			
			$start_year = $active_year - 3;
			$end_year = $active_year + 3;
			
			if ($last_year - $active_year < 3)
				$start_year = $active_year - 6 + ($last_year - $active_year);
			else if ($active_year - $first_year < 3)
				$end_year = $active_year + 6 - ($active_year - $first_year);
			
			if ($start_year < $first_year)
				$start_year = $first_year;
			
			if ($end_year > $last_year)
				$end_year = $last_year;
		?>
		
		<div class="header__more header__more--hidden">
			<?php for ($year = ($last_year - $last_year%10); $year >= $first_year; $year -= 10): ?>
				<div class="header__year">
					<a href="<?php echo base_url($year); ?>">
						<?php echo $year; ?>
					</a>
				</div>
			<?php endfor; ?>
		</div>
		
		<?php for ($year = $end_year; $year > $active_year; $year--): ?>
			<?php
				if ($year - $active_year > 2)
					$additional_class = 'header__year--additional';
				else
					$additional_class = '';
			?>
			<div class="header__year <?php echo $additional_class; ?>">
				<a href="<?php echo base_url($year); ?>">
					<?php echo $year; ?>
				</a>
			</div>
		<?php endfor; ?>
		
		<div class="header__year header__year--active">
			<a href="<?php echo base_url($active_year); ?>"><?php echo $active_year; ?></a>
		</div>
		
		<?php for ($year = $active_year - 1; $year >= $start_year; $year--): ?>
			<?php
				if ($active_year - $year > 2)
					$additional_class = 'header__year--additional';
				else
					$additional_class = '';
			?>
			
			<div class="header__year <?php echo $additional_class; ?>">
				<a  href="<?php echo base_url($year); ?>">
					<?php echo $year; ?>
				</a>
			</div>
		<?php endfor; ?>
		
		<button class="header__toggleMore">více</button>
	</nav>
</header>
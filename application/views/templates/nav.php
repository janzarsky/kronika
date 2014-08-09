<nav class="navbar">
	<?php
		$first_year = (isset($first_year)) ? $first_year : 1963;
		$last_year = (isset($last_year)) ? $last_year : date("Y");
		
		$first_decade = floor($first_year/10)*10;
		$last_decade = floor($last_year/10)*10;
		
		$active_year = (isset($active_year)) ? $active_year : $last_year;
	?>
	
	<?php for($decade = $last_decade; $decade >= $first_decade; $decade -= 10): ?>
		<div class="navbar__panel">
			<a href="<?php echo $decade + 9; ?>">
				<header class="navbar__panelHeading">
					<?php echo substr($decade, 2, 2) . '\''; ?>
				</header>
			</a>
			
			<?php $collapsed = (($active_year - $decade) < 10 && ($active_year - $decade) >= 0) ? "" : "navbar__panelCollapse--collapsed"; ?>
			
			<div class="navbar__panelCollapse <?php echo $collapsed; ?>">
				<ul class="navbar__itemGroup">
					<?php for($year = $decade + 9; $year >= $decade; $year--): ?>
						<?php $active = ($year == $active_year) ? "navbar__item--active" : ""; ?>
						<a href="<?php echo $year; ?>">
							<li class="navbar__item <?php echo $active; ?>">
								<?php echo $year; ?>
							</li>
						</a>
					<?php endfor; ?>
				</ul>
			</div>
		</div>
	<?php endfor; ?>
</nav>
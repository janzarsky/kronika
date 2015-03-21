<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url('admin'); ?>">Kronika</a>
		</div>
		
		<?php if (isset($page) == false) $page = ''; ?>

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php if (isset($permissions)): ?>
					<li <?php echo ($page == 'archive') ? 'class="active"' : ''; ?>>
						<a href="<?php echo base_url('archive'); ?>">Události</a>
					</li>
					
					<?php if ($permissions['can_edit_users']): ?>
						<li <?php echo ($page == 'users') ? 'class="active"' : ''; ?>>
							<a href="<?php echo base_url('users'); ?>">Uživatelé</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>
			</ul>
			
			<?php if (isset($name)): ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url('add'); ?>">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						Přidat událost
					</a></li>
					<li><a href="<?php echo base_url('profile'); ?>"><?php echo $name; ?></a></li>
					<li><a href="<?php echo base_url('logout'); ?>">Odhlásit se</a></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</nav>
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

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo base_url('admin/archive'); ?>">Události</a></li>
				
				<?php if ($permissions['can_edit_users']): ?>
					<li><a href="<?php echo base_url('admin/users'); ?>">Uživatelé</a></li>
				<?php endif; ?>
				
				<?php if ($permissions['can_edit_settings']): ?>
					<li><a href="<?php echo base_url('admin/settings'); ?>">Nastavení</a></li>
				<?php endif; ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo base_url('admin/profile'); ?>"><?php echo $name; ?></a></li>
				<li><a href="<?php echo base_url('logout'); ?>">Odhlásit se</a></li>
			</ul>
		</div>
	</div>
</nav>
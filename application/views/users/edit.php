<section class="userEdit">
	<form class="form form-horizontal" role="form" action="" method="post">
		<div class="form-group">
			<label class="sr-only" for="user_name">Jméno</label>
			<input type="text" class="form-control" name="name" id="user_name" placeholder="Jméno"
				value="<?php echo set_value('name', $user['name']); ?>">
		</div>	
		
		<div class="form-group">
			<label class="sr-only" for="user_email">Email</label>
			<input type="text" class="form-control" name="email" id="user_email" placeholder="Email"
				value="<?php echo set_value('email', $user['email']); ?>">
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Uložit</button>
			<a class="btn btn-default" href="<?php echo base_url('/users'); ?>" role="button">Zavřít</a>
		</div>
	</form>
</section>
<section class="event">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<h1>Kronika</h1>
			
			<?php if ($this->session->flashdata('message') != false): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('message'); ?>
				</div>
			<?php endif; ?>
			
			<form role="form" action="login/submit" method="post">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="password">Heslo</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Přihlásit se</button>
			</form>
		</div>
	</div>
</section>
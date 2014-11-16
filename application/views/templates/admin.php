<?php echo doctype('html5'); ?>
<html lang="en">
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<meta name="description" content="Website for keeping important events from history" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
	
	<link href="<?php echo stylesheet('bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo stylesheet('admin.css'); ?>" rel="stylesheet">
</head>
<body>
	<?php
		if (isset($header))
			echo $header;
	?>
	
	<div class="container-fluid">
		<?php if ($this->session->flashdata('message') != ''): ?>
			<?php
				if ($this->session->flashdata('message_type') == '')
					$type = 'success';
				else
					$type = $this->session->flashdata('message_type');
			?>
			
			<div class="row">
				<div class="col-sm-12">
					<div class="alert alert-<?php echo $type; ?>" role="alert">
						<?php echo $this->session->flashdata('message'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<?php echo $content; ?>
	</div>
	
	<script src="<?php echo javascript('jquery.min.js'); ?>"></script>
	<script src="<?php echo javascript('bootstrap.min.js'); ?>"></script>
</body>
</html>
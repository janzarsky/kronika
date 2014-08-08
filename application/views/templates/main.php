<?php echo doctype('html5'); ?>
<html lang="en">
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<meta name="description" content="Website for keeping important events from history" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link href="<?php echo stylesheet('bootstrap-custom.css'); ?>" rel="stylesheet">
	<link href="<?php echo stylesheet('screen.css'); ?>" rel="stylesheet">
</head>
<body>
	<div class="container">
		<?php
			if (isset($header))
				echo $header;
			else
				$this->load->view('templates/header');
		?>
		<?php
			if (isset($nav))
				echo $nav;
		?>
		<?php echo $content; ?>
	</div>
	
	<script src="<?php echo javascript('jquery.min.js'); ?>"></script>
	<script src="<?php echo javascript('bootstrap.min.js'); ?>"></script>
</body>
</html>
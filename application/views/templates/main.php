<?php echo doctype('html5'); ?>
<html lang="en">
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<meta name="description" content="Website for keeping important events from history" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
	
	<link href="<?php echo stylesheet('bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo stylesheet('screen.css'); ?>" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
		<?php
			if (isset($header))
				echo $header;
			else
				$this->load->view('templates/header');
		?>
		
		<?php echo $content; ?>
		
		<?php
			if (isset($footer))
				echo $footer;
			else
				$this->load->view('templates/footer');
		?>
	</div>
	
	<script src="<?php echo javascript('jquery.min.js'); ?>"></script>
	<script src="<?php echo javascript('main.js'); ?>"></script>
</body>
</html>
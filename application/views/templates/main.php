<?php echo doctype('html5'); ?>
<html lang="en">
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<meta name="description" content="Website for keeping important events from history" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link href="public/stylesheets/bootstrap-custom.css" rel="stylesheet">
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
			else
				$this->load->view('templates/nav');
		?>
		<?php echo $content; ?>
	</div>
	
	<script src="public/javascripts/jquery.min.js"></script>
	<script src="public/javascripts/bootstrap.min.js"></script>
</body>
</html>
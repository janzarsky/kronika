<?php echo doctype('html5'); ?>
<html>
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<?php	echo meta(array('name' => 'description', 'content' => 'Website for keeping important events from history')); ?>
	
	<link href="public/stylesheets/bootstrap-custom.css" rel="stylesheet">
</head>
<body>
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
	
	<script src="public/javascripts/jquery.min.js"></script>
	<script src="public/javascripts/bootstrap.min.js"></script>
</body>
</html>
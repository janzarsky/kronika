<?php echo doctype('html5'); ?>
<html lang="en">
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<meta name="description" content="Website for keeping important events from history" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
	
	<link href="<?php echo stylesheet('bootstrap-custom.css'); ?>" rel="stylesheet">
	<link href="<?php echo stylesheet('admin.css'); ?>" rel="stylesheet">
	
	<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php
		if (isset($header))
			echo $header;
	?>
	
	<div class="container-fluid">
		<?php echo $content; ?>
	</div>
	
	<script src="<?php echo javascript('jquery.min.js'); ?>"></script>
	<script src="<?php echo javascript('bootstrap.min.js'); ?>"></script>
</body>
</html>
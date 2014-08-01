<?php echo doctype('html5'); ?>
<html>
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<?php	echo meta(array('name' => 'description', 'content' => 'Website for keeping important events from history')); ?>
</head>
<body>
	<?php if (isset($header)) echo $header; ?>
	<?php if (isset($nav))  echo $nav; ?>
	<?php echo $content; ?>
</body>
</html>
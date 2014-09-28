<?php echo doctype('html5'); ?>
<html lang="en">
<head>
	<title>Kronika</title>
	<meta charset="UTF-8">
	<meta name="description" content="Website for keeping important events from history" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link href="<?php echo stylesheet('bootstrap-custom.css'); ?>" rel="stylesheet">
	<link href="<?php echo stylesheet('screen.css'); ?>" rel="stylesheet">
	
	<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container-fluid">
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
	<script src="<?php echo javascript('responsiveslides.min.js'); ?>"></script>
	<script>
		$(function() {
			$(".rslides").responsiveSlides({
				auto: false,						// Boolean: Animate automatically, true or false
				speed: 500,							// Integer: Speed of the transition, in milliseconds
				timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
				pager: false,           // Boolean: Show pager, true or false
				nav: true,             	// Boolean: Show navigation, true or false
				random: false,          // Boolean: Randomize the order of the slides, true or false
				pause: false,           // Boolean: Pause on hover, true or false
				pauseControls: false,   // Boolean: Pause when hovering controls, true or false
				prevText: '<span class="glyphicon glyphicon-chevron-left"></span>',   // String: Text for the "previous" button
				nextText: '<span class="glyphicon glyphicon-chevron-right"></span>',  // String: Text for the "next" button
				maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
				navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
				manualControls: "",     // Selector: Declare custom pager navigation
				namespace: "rslides",   // String: Change the default namespace used
				before: function(){},   // Function: Before callback
				after: function(){}     // Function: After callback
			});
		});
	</script>
</body>
</html>
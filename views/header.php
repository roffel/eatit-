<html>
<head>
	<link rel="stylesheet" href="<?=URL?>public/css/the.css" />
	<script src="<?=URL?>public/js/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div id="header">
		<a href="<?=URL?>" title="Home"><img src="<?=URL?>public/img/logo.png" alt="EatIT" id="logo" /></a>
		<div class="menu">
			<a href="<?=URL?>index">Home</a>
			<a href="<?=URL?>menus">Menu's</a>
			<?php if (Session::get('loggedIn') == true):?>
				<a href="<?php echo URL; ?>orders">Bestellijst</a>	
				<a href="<?php echo URL; ?>dashboard/logout" class="floatr">Uitloggen</a>	
			<?php else: ?>
				<a href="<?php echo URL; ?>login" class="floatr">Inloggen</a>
			<?php endif; ?>	
		</div>	
	</div>
	<div id="wrapper">
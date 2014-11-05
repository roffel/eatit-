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
			<?php 
			if (Session::get('loggedIn') == true)
			{
				if($_SESSION['user']['rang'] == "gebruiker")
				{
					echo "<a href=\"".URL."orders\">Bestellijst</a>";
					echo "<a href=\"".URL."instellingen\">Instellingen</a>";
				}
				elseif ($_SESSION['user']['rang'])
				{
					echo "<a href=\"".URL."orders/all\">Beheer</a>";
				}
				echo "<a href=\"".URL."dashboard/logout\" class=\"lurl\">Uitloggen</a>";	
			} 
			else
			{
				echo "<a href=\"".URL."login\" class=\"lurl\">Inloggen</a>";
			}
			?>
		</div>	
	</div>
	<div id="wrapper">
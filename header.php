<?php

	include ("conf/conf.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="vendor/css/navbar.css">
		<link rel="stylesheet" type="text/css" href="vendor/css/default.css">
		<link rel="stylesheet" type="text/css" href="vendor/css/card.css">

		<meta charset="UTF-8">
	</head>
	<body>
		<!-- NAV BAR -->
		<ul class="topnav">
			<!-- SITE TITLE -->
			<li class="navtitle" style="flex-grow: 1">
				LA ROTI
			</li>

			<!-- NAV LINKS -->
			<li style="flex-grow: 1">
				<a class="topnav-btn active" href="index.php">Accueil</a>
			</li>
			<li style="flex-grow: 1">
				<a class="topnav-btn" href="carte.php">La carte</a>
			</li>
			<li style="flex-grow: 1">
				<a class="topnav-btn" href="index.php">Nous contacter</a>
			</li>
			<li style="flex-grow: 1">
				<a class="topnav-btn" href="admin/index.php">Administration</a>
			</li>

			<!-- CONNECTION INDICATOR -->
			<li class="right navtext" style="flex-grow: 3;">
				Vous n'êtes pas connectés
				<a href="#">Connexion</a>
			</li>
		</ul>
		<div class="topnav-clean-bottom"></div>
	</body>
</html>
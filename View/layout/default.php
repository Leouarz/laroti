<!DOCTYPE html>
<html>
	<head>
		<!-- IMPORT CSS STYLESHEET -->
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/navbar.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/default.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/card.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/fontawesome.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/cart.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/form.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/table.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/alert.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/box.css">'; ?>

		<!-- CHAR ENCODING -->
		<meta charset="UTF-8">
	</head>
	<body>

		<div class="cart-container" id="cart">
			<div class="cart-head">
				<h3 style="text-align: left;">
					Votre Commande
					<i class="fa fa-times" onclick="CloseCart();"></i>
				</h3>
			</div>
			<ul class="cart-list" id="cart-list">
				
			</ul>
		</div>

		<!-- NAV BAR -->
		<ul class="topnav">
			<!-- SITE TITLE -->
			<li class="navtitle">
				LA ROTI
			</li>

			<!-- NAV LINKS -->
			<li>
				<?php echo '<a class="topnav-btn" href="' . ROOT_PATH . 'index">Accueil</a>'; ?>
			</li>
			<li>
				<?php echo '<a class="topnav-btn" href="' . ROOT_PATH . 'carte">La carte</a>'; ?>
			</li>

			<?php

				if (!isset($_SESSION)) {
					session_start();
				}
			
				if (isset($_SESSION["UADMIN"]) && $_SESSION["UADMIN"]) {
					echo '
						<li>
							<a class="topnav-btn active" href="' . ROOT_PATH . 'admin">Admin panel</a>
						</li>
					';
				}
			
			?>	

			<!-- CART DISPLAY -->
			<li class="right dropdown">
				<a class="topnav-btn active" onclick="OpenCart()">
					<i class="fa fa-shopping-cart" style=""></i>
					Panier 
				</a>
			</li>

			<!-- CONNECTION INDICATOR -->
			<li class="right navtext">
				<?php
					
					if (!isset($_SESSION)) {
						session_start();
					}
					
					if (isset($_SESSION["UID"])) {
						// Is connected
						echo 'Bonjour '. $_SESSION["UNAME"] .' ! <a href="' . ROOT_PATH . 'session/disconnect">Déconnexion</a>';
					} else {
						// Is not connected
						echo 'Vous n\'êtes pas connecté, <a href="' . ROOT_PATH . 'session/login">Connexion</a>';
					}
				
				?>
			</li>
		</ul>


		<div class="topnav-clean-bottom"></div>
	</body>
</html>

<div class="content" id="content">

	<div id="alert-box" style="display: none;">
				
	</div>

	<?php echo $layout_content; ?>
	
</div>

<!-- IMPORT JS SCRIPT -->
<?php echo '<script type="text/javascript" src="' . ROOT_PATH . 'Vendor/js/jquery-3.2.1.min.js"></script>'; ?>
<?php echo '<script type="text/javascript" src="' . ROOT_PATH . 'Vendor/js/cart.js"></script>'; ?>
<?php echo '<script type="text/javascript" src="' . ROOT_PATH . 'Vendor/js/session.js"></script>'; ?>
<?php echo '<script type="text/javascript" src="' . ROOT_PATH . 'Vendor/js/alert.js"></script>'; ?>

<script type="text/javascript">
	const root_path = <?php echo ROOT_PATH; ?>;
</script>
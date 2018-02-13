<!DOCTYPE html>
<html>
	<head>
		<title>Admin LAROTI</title>

		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/navbar.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/default.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/card.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/fontawesome.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/cart.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/form.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/table.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/alert.css">'; ?>
		<?php echo '<link rel="stylesheet" type="text/css" href="' . ROOT_PATH . 'Vendor/css/box.css">'; ?>
	</head>
	<body style="background-color: #f0f0f0;">

		<div class="sidenav">
			<?php echo '<a class="rounded" href="' . ROOT_PATH . '/home/index"><i class="fa fa-arrow-left"></i> Retour au site</a>'; ?>
			<?php echo '<a href="' . ROOT_PATH . '/admin/commande">Liste des commandes</a>'; ?>
		</div>

		<div class="sidenav-content">
		
			<?php echo $layout_content; ?>

		</div>
	</body>
</html>
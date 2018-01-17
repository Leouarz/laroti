<?php

	function __autoload($class_name) {
	    include "../Model/" . $class_name . '.php';
	}

	$Model = new PanierModel();

	switch ($_POST["function"]) {
		case 'ajout_panier':
			// Execute and return result of the function
			$id = $_POST["product_id"];
			echo $Model->ajout_panier($id);
		break;
		case 'get_panier':
			// Execute and return result of the function
			echo $Model->get_panier();
		break;
		
		default:
			# code...
			break;
	}

?>
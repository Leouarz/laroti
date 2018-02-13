<?php

	/* Define some usefull variables */

	// Root directory (= this file path - this file name)
	define('ROOT', str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));

	// Root full path (= this file full path - this file name)
	define('WEBROOT', str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));
	

	/* Include Configurations */
	
	require(WEBROOT."Config/conf.php");

	require(WEBROOT."Core/controller.php");
	require(WEBROOT."Core/model.php");

	/* Read URL parameters */

	// GET URL parameters (IF they exist)
	if (isset($_GET["page"])) {
		$url_params = explode("/", $_GET["page"]);
	}
	
	// CHECK : className defined
	if (isset($url_params[0]) && $url_params[0]!= "") {
		$controller = ucwords(strtolower(array_shift($url_params)))."Controller";
	} else {
		$controller = "HomeController";
	}

	// CHECK : actionName defined
	if (isset($url_params[0]) && $url_params[0]!= "") {
		$action = array_shift($url_params);
	} else {
		$action = "index";
	}

	// CHECK : Controller file exists
	if (file_exists(WEBROOT."Controller/".$controller.".php")) {
		require(WEBROOT."Controller/".$controller.".php");
	} else {
		echo "Erreur 404 : Fichier controlleur innexistant";
		exit();
	}

	// CHECK : class defined
	if (class_exists($controller)) {
		// Initialize Controller
		$controller = new $controller();
	} else {
		// Error: undefined class
		echo "Erreur 404: Classe non définie";
		exit();
	}

	// CHECK : action defined
	if (method_exists($controller, $action)) {

		// CHECK : parameters defined
		if (isset($url_params[0]) && $url_params[0]!= "") {
			// Make required Action
			$controller->$action($url_params);
		} else {
			// Make required Action
			$controller->$action();
		}
		
	} else {
		// Error: undefined action
		echo "Erreur 404: Méthode non définie";
		exit();
	}

?>
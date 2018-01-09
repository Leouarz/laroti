<?php

	// Error reporting
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// GET XML conf file
	$xmlConfData = new SimpleXMLElement('conf/conf.xml', null, true);

	// GET DB information
	$db_credentials = $xmlConfData->xpath('/databases/database[@name="leveau"]')[0];

	// SET a PDO connection
	$dsn = 'mysql:host=' . $db_credentials->host . ';dbname='. $db_credentials->name ;
	$user = $db_credentials->user;
	$password = $db_credentials->pass;
	try {
		$pdo = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connexion échouée : ' . $e->getMessage();
	}
	
?>
<?php

	/**
	*    This is the mother Model !
	*/
	class Model
	{
		
		protected 	$PDO 				= null;
		protected 	$COOKIE_DURATION 	= 1600;

		function __construct()
		{
			// SET a PDO connection
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			);
			$dsn = DB_DSN ;
			$user = DB_USER;
			$password = DB_PASS;

			try {
				$this->PDO = new PDO($dsn, $user, $password, $options);
			} catch (PDOException $e) {
				echo 'Connexion échouée : ' . $e->getMessage();
			}
		}
	}

?>	
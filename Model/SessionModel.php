<?php

	/**
	* 	Manage Session datas
	*/
	class SessionModel extends Model
	{
		
		/**
		* 	Return connection indicator
		*/
		public function isConnected() 
		{
			if (session_id() == "") {
				session_start();
			}
			return isset($_SESSION['UID']);
		}

		/**
		* 	Return admin indicator
		*/
		public function isAdmin() 
		{
			if (session_id() == "") {
				session_start();
			}
			return $_SESSION['UADMIN'];
		}

		/**
		* 	Return UID
		*/
		public function getUID() 
		{
			if (session_id() == "") {
				session_start();
			}
			return $_SESSION['UID'];
		}

		/**
		* 	Check credentials
		*/
		public function checkCredentials($email, $mdp) 
		{

			// GET each product
			$matching_account = $this->PDO->query("
						SELECT 		*
						FROM 		utilisateur
						WHERE 		email = '". $email ."'
						AND 		password = '" . sha1($mdp) . "'
					");
			
			return sizeof($matching_account->fetchAll()) > 0;
		}

		/**
		* 	Try to insert an user
		*/
		public function signup($nom, $prenom, $adresse, $cp, $ville, $mail, $mdp)
		{
			// GET each product
			$matching_account = $this->PDO->query("
						SELECT 		*
						FROM 		utilisateur
						WHERE 		email = '". $mail ."'
					");
			
			// If email already used
			if (sizeof($matching_account->fetchAll()) > 0) {
				return 0;
			}

			// insert value
			$this->PDO->query("	INSERT INTO utilisateur (nom, prenom, email, adresse, cp, ville, password)
								VALUES(	'".addslashes($nom)."',
										'".addslashes($prenom)."',
										'".addslashes($mail)."',
										'".addslashes($adresse)."',
										'".addslashes($cp)."',
										'".addslashes($ville)."',
										'".addslashes(sha1($mdp))."'
										)");
			return 1;
		}

		/**
		* 	Unset session
		*/
		public function disconnect() 
		{
			if (session_id() == "") {
				session_start();
			}			session_unset();
    		session_destroy();
		}

		/**
		* 	Set user session
		*/
		public function connect($email, $mdp) 
		{

			if (session_id() == "") {
				session_start();
			}
			// GET each product
			$matching_account = $this->PDO->query("
						SELECT 		*
						FROM 		utilisateur
						WHERE 		email = '". $email ."'
						AND 		password = '" . sha1($mdp) . "'
					");
			
			$user_data = $matching_account->fetch();
			$_SESSION["UID"] 	= $user_data["id"];
			$_SESSION["UNAME"] 	= $user_data["prenom"];
			$_SESSION["UADMIN"] = $user_data["admin"];
		}
	}

?>
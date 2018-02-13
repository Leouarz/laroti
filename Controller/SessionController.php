<?php

	/**
	* 	Manage user sessions
	*/
	class SessionController extends Controller
	{
		
		/**
		* 	Render login view
		*/
		public function login() 
		{
			// If already connected -> redirect to home
			if ($this->isConnected()) {
				// Use home controller for redirection
				$this->useController("Home");
				$homeController = new HomeController();
				$homeController->index();
			} else {
				$this->render("login");
			}
		}

		/**
		* 	Render register view
		*/
		public function register() 
		{
			// If already connected -> redirect to home
			if ($this->isConnected()) {
				// Use home controller for redirection
				$this->useController("Home");
				$homeController = new HomeController();
				$homeController->index();
			} else {
				$this->render("register");
			}
		}

		/**
		* 	Try a connection
		*/
		public function connect($parameters = null) 
		{

			$parameters = $_POST;

			// Extract parameters
			if (isset($parameters["mail"]) && isset($parameters["mdp"])) {
				$email 	= $parameters["mail"];
				$mdp 	= $parameters["mdp"];
			} else {
				$email 	= "";
				$mdp 	= "";
			}
			

			// Initialize response
			$response = array();
			$response["error"] = array();
			$response["status"] = 0;
			// Check parameters
			$no_problem = 1;
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$response["error"]["email"] = "Le mail n'est pas valide.";
				$no_problem = 0;
			}
			if ($mdp == "") {
				$response["error"]["mdp"] = "Le MDP n'est pas présent.";
				$no_problem = 0;
			}

			// IF params are valid, lets try a conection
			if ($no_problem) {
				$this->useModel("session");
				$sessionModel = new SessionModel();

				// IF connection failed
				if(!$sessionModel->checkCredentials($email, $mdp)){
					$response["error"]["credentials"] = "La combinaison Email - MDP ne correspond pas.";
				} else {
					// IF Connection OK
					$sessionModel->connect($email, $mdp);

					$response["status"] = 1;
				}
			}

			echo json_encode($response);
		}

		/**
		* 	Close user session
		*/
		public function disconnect() 
		{
			// use session model
			$this->useModel("session");
			$sessionModel = new SessionModel();

			// Unset the session
			$sessionModel->disconnect();

			// Render the homepage
			$this->useController("home");
			$homeController = new HomeController();
			$homeController->index();
		}

		/**
		* 	Return connection indicator
		*/
		public function isConnected() 
		{
			// Use model for query
			$this->useModel("Session");
			$sessionModel = new SessionModel();
			return $sessionModel->isConnected();
		}

		/**
		* 	Return admin indicator
		*/
		public function isAdmin() 
		{
			// Use model for query
			$this->useModel("Session");
			$sessionModel = new SessionModel();
			return $sessionModel->isAdmin();
		}

		/**
		* 	Get UID
		*/
		public function getUID() 
		{
			// Use model for query
			$this->useModel("Session");
			$sessionModel = new SessionModel();
			return $sessionModel->getUID();
		}

		/**
		* 	try to sign up
		*/
		public function signup() 
		{
			$parameters = $_POST;
			$no_error = 1;

			// check nom
			if (isset($parameters["nom"]) && $parameters["nom"] != ""){
				$nom = strtoupper($parameters["nom"]);
			} else {
				$response["error"]["nom"] = "Le nom est invalide.";
				$no_error = 0;
			}

			// check prenom
			if (isset($parameters["prenom"]) && $parameters["prenom"] != ""){
				$prenom = ucwords(strtolower($parameters["prenom"])); // camel case
			} else {
				$response["error"]["prenom"] = "Le prenom est invalide.";
				$no_error = 0;
			} 

			// check adresse
			if (isset($parameters["adresse"]) && $parameters["adresse"] != ""){
				$adresse = $parameters["adresse"];
			} else {
				$response["error"]["adresse"] = "L'adresse est invalide.";
				$no_error = 0;
			} 

			// check cp
			if (isset($parameters["cp"]) && $parameters["cp"] != "" && preg_match('#^[0-9]{5}$#', $parameters["cp"])){
				$cp = $parameters["cp"];
			} else {
				$response["error"]["cp"] = "Le code postal est invalide.";
				$no_error = 0;
			} 

			// check ville
			if (isset($parameters["ville"]) && $parameters["ville"] != ""){
				$ville = strtoupper($parameters["ville"]);
			} else {
				$response["error"]["ville"] = "La ville est invalide.";
				$no_error = 0;
			} 

			// check mail
			if (isset($parameters["mail"]) && $parameters["mail"] != "" && filter_var($parameters["mail"], FILTER_VALIDATE_EMAIL)){
				$mail = $parameters["mail"];
			} else {
				$response["error"]["mail"] = "Le mail est invalide.";
				$no_error = 0;
			} 
			// check mdp
			if (isset($parameters["mdp"]) && $parameters["mdp"] != ""){
				$mdp = $parameters["mdp"];
			} else {
				$response["error"]["mdp"] = "Le mdp est invalide.";
				$no_error = 0;
			}

			$this->useModel("session");
			$sessionModel = new SessionModel();

 			// Try to insert data
			if ($no_error) {
				if ($sessionModel->signup($nom, $prenom, $adresse, $cp, $ville, $mail, $mdp)) {
					$response["status"] = 1;
				} else {
					$response["error"]["mail"] = "Le mail est déjà pris.";
				}
			} 

			echo json_encode($response);
		}
	}

	?>
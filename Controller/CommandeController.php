<?php

	/**
	* 	Command manager
	*/
	class CommandeController extends Controller
	{
		
		/**
		* 	Render the command overview
		*/
		public function recapitulatif() 
		{
			// Check if user is connected
			$this->useController("session");
			$sessionController = new SessionController();

			if ($sessionController->isConnected()) {
				// Is connected

				$this->useController("panier");
				$panierController = new PanierController();
				
				$this->set(array(
					"cart_content" => $panierController->_get_panier()
				));

				$this->render("recapitulatif");
			} else {
				// Is not connected
				$sessionController->login();
			}
		}

		/**
		* 	return commands with "fini" field at 0
		*/
		public function getUnfinishedCommands() 
		{
			$this->useModel("commande");
			$commandeModel = new CommandeModel();

			$array_to_send = array();

			$commands = $commandeModel->getUnfinishedCommands();
			foreach ($commands as $key => $command) {
				$array_to_send[$key] = $command;
				$array_to_send[$key]["products"] = $commandeModel->getProductsByCommand($command["id_command"]);
			}

			return $array_to_send;
		}

		/**
		* 	Add a command
		*/
		public function add_command() 
		{
			// Initialize variables
			$response = array(
				"status" 	=> 1,
				"error" 	=> ""
			);

			// IF no products
			$this->useController("panier");
			$panierController = new PanierController();
			if (empty(json_decode($panierController->_get_panier()))) {
				$response["status"] = 0;
				$response["error"]	= "Il n'y a pas de produit dans le panier.";
			}

			// IF no client connected
			$this->useController("session");
			$sessionController = new SessionController();
			if (!$sessionController->isConnected()) {
				$response["status"] = 0;
				$response["error"]	= "Il n'y a pas de client connecté.";
			}

			if ($response["status"]) {
				$this->useModel("commande");
				$commandeModel = new CommandeModel();

				$product_array = json_decode($panierController->_get_panier());
				$uid = $sessionController->getUID();

				$commandeModel->add_command($uid, $product_array);
			}

			echo json_encode($response);
		}
	}

?>
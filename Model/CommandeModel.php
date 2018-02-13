<?php

	/**
	* 	Manage command data
	*/
	class CommandeModel extends Model
	{
		
		/**
		* 	add a new command
		*/
		public function add_command($id_client, $product_array) 
		{
			// Command ID
			$id_command = uniqid();

			// 1- add the command
			$sqlStatement = $this->PDO->prepare("
				INSERT INTO commande (id, client)
				VALUES (?, ?)");
			$sqlStatement->execute(
				array(
					$id_command,
					$id_client
				)
			);

			// 2- Add products to the command
			$sqlStatement = $this->PDO->prepare("
				INSERT INTO produit_commande (produit, commande, quantite)
				VALUES (?, ?, ?)");

			foreach ($product_array as $product) {
				$sqlStatement->execute(
					array(
						$product->id,
						$id_command,
						$product->quantite
					)
				);
			}
		}

		/**
		* 	Return the command products
		*/
		public function getProductsByCommand($id_command) 
		{
			try {
				$products = $this->PDO->query("
						SELECT 
							pc.quantite as quantite,
							cp.libelle as categorie_lib,
							p.*
						FROM 
							produit_commande pc,
							categorie_produit cp,
							produit p
						WHERE 
							pc.commande = '".$id_command."'
							AND pc.produit = p.id
							AND cp.id = p.categorie"
					);
			} catch (Exception $e) {
				var_dump($e);
			}

			$array_to_send = array();
			foreach ($products as $key => $product) {
				$array_to_send[$key] = $product;
			}

			return $array_to_send;
		}

		/**
		* 	return commands with "fini" field at 0
		*/
		public function getUnfinishedCommands() 
		{
			try {
				return $this->PDO->query("
						SELECT 
							c.id as id_command,
							c.date as date_command,
							u.*
						FROM 
							commande c,
							utilisateur u
						WHERE 
							c.fini = 0
							AND u.id = c.client
						ORDER BY c.date asc"
					);
			} catch (Exception $e) {
				var_dump($e);
			}
			
		}
	}

?>
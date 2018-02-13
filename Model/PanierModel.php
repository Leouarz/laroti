<?php

	/**
	*    Manage Panier datas
	*/
	class PanierModel extends Model
	{
		
		/**
		* 	Add a product to cart
		*/
		public function ajout_panier($id) 
		{
			
			// IF not isset panier COOKIE
			if (!isset($_COOKIE["panier"])) {
				setcookie("panier", "[]", time() + $this->COOKIE_DURATION, "/");
			}
			
			// GET panier and complete it
			$panier = (array) json_decode($_COOKIE["panier"]);

			if (array_key_exists("ID#".$id, $panier)) {
				$panier["ID#".$id]->quantite += 1;
			} else {
				$panier["ID#".$id]["quantite"] = 1;
				$panier["ID#".$id]["id"] = $id;
			}
			
			// Modification du panier
			setcookie("panier", json_encode($panier), time() + $this->COOKIE_DURATION, "/");

			return $_COOKIE["panier"];
		}

		/**
		* 	Return panier content
		*/
		function get_panier() 
		{

			// GET panier
			if (isset($_COOKIE["panier"])) {
				$panier = (array) json_decode($_COOKIE["panier"]);
			} else {
				$panier = [];
			}
			
			$array_panier = [];

			// Get product data
			$product_query = $this->PDO->prepare("
								SELECT 		p.*, cp.libelle as CP_LIB
								FROM 		produit p, categorie_produit cp
								WHERE 		cp.id = p.categorie
								AND 		p.id = :product_id"
							);
			foreach ($panier as $id => $data) {
				// GET DB data
				$product_query->execute(array("product_id" => $data->id));
				$produit_data = $product_query->fetchAll();

				// SET data to return
			 	$array_panier[$id]["quantite"] = $data->quantite;
			 	$array_panier[$id]["libelle"] = $produit_data[0]["libelle"];
			 	$array_panier[$id]["cp_libelle"] = $produit_data[0]["CP_LIB"];
			 	$array_panier[$id]["prix"] = $produit_data[0]["prix"];
			 	$array_panier[$id]["id"] = $produit_data[0]["id"];
			}

			// return datas
			return json_encode($array_panier);
		}

		/**
		* 	Drop a product from cart
		*/
		public function drop_panier($id) 
		{
			
			// IF not isset panier COOKIE
			if (!isset($_COOKIE["panier"])) {
				setcookie("panier", "[]", time() + $this->COOKIE_DURATION, "/");
			}
			
			// GET panier and complete it
			$panier = (array) json_decode($_COOKIE["panier"]);

			if (array_key_exists("ID#".$id, $panier)) {
				unset($panier["ID#".$id]);
			}
			
			// Modification du panier
			setcookie("panier", json_encode($panier), time() + $this->COOKIE_DURATION, "/");

			return $_COOKIE["panier"];
		}

		/**
		* 	Drop all products from cart
		*/
		public function drop_all_panier() 
		{
			
			setcookie("panier", "[]", time() + $this->COOKIE_DURATION, "/");

			return $_COOKIE["panier"];
		}
	}

?>
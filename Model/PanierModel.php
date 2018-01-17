<?php

	require ("../conf/conf.php");

	/**
	*    Gestion du panier de l'utilisateur
	*/
	class PanierModel
	{

		private $PDO 				= null;
		private $COOKIE_DURATION 	= 1600;
		
		function __construct()
		{
			// SET a PDO connection
			$dsn = DB_DSN ;
			$user = DB_USER;
			$password = DB_PASS;

			try {
				$this->PDO = new PDO($dsn, $user, $password);
			} catch (PDOException $e) {
				echo 'Connexion échouée : ' . $e->getMessage();
			}
		}

		/**
		* 	Ajoute un produit au panier
		*/
		public function ajout_panier($id) 
		{
			// IF not isset panier COOKIE
			if (!isset($_COOKIE["panier"])) {
				setcookie("panier", "[]", time() + 1600);
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
			setcookie("panier", json_encode($panier), time() + 1600);

			return "Ajout OK, état du panier : " . json_encode($panier);
		}

		/**
		* 	Return panier content
		*/
		function get_panier() 
		{

			// GET panier
			$panier = (array) json_decode($_COOKIE["panier"]);
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
			 	$array_panier[$id]["img_path"] = $produit_data[0]["CP_LIB"]."/".$produit_data[0]["image"];
			}

			// return datas
			return json_encode($array_panier);
		}
	}

?>
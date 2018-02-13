<?php

	/**
	*    Manage product Datas
	*/
	class ProduitModel extends Model
	{
		
		/**
		* 	Return all products
		*/
		public function getAllProduct() 
		{
			// GET each product
			return $this->PDO->query("
						SELECT 		p.*, cp.libelle as CP_LIB
						FROM 		produit p, categorie_produit cp
						WHERE 		cp.id = p.categorie
						ORDER BY 	categorie
					");
		}
		
		/**
		* 	Return all products from a category
		*/
		public function getProductByCategory($category) 
		{
			// GET each product
			return $this->PDO->query("
						SELECT 		p.*, cp.libelle as CP_LIB
						FROM 		produit p, categorie_produit cp
						WHERE 		cp.id = p.categorie
						AND 		cp.libelle = '".$category."'
						ORDER BY 	categorie
					");
		}
	}

?>
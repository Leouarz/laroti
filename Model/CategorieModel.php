<?php

	/**
	*   This Model manage Product category data
	*/
	class CategorieModel extends Model
	{
		
		/**
		* 	Return all product categories
		*/
		public function getAllCategories() 
		{
			return $this->PDO->query("SELECT * FROM categorie_produit ORDER BY ordre");
		}
	}

?>		
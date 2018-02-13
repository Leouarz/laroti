<?php

	/**
	*   Manage Laroti Carte display
	*/
	class CarteController extends Controller
	{
		
		function index()
		{
			// Use Model for Querie
			$this->useModel("Categorie");
			$PCModel = new CategorieModel();
			$this->useModel("Produit");
			$PModel = new ProduitModel();

			$product_categories = array();

			// Get all product categories data
			$categories = $PCModel->getAllCategories();
			foreach ($categories as $key => $category) {
				// Index -> no category selected
				$product_categories[$key] = $category;
				$product_categories[$key]["active"] = 0;
			}

			$this->set(array(
					"product_categories" => $product_categories,
					"title" => "Tous les produits",
					"products" => $PModel->getAllProduct()
				));

			// render the view
			$this->render("index");
		}

		/**
		* 	Filter by product category
		*/
		public function filterOnCategory($parameters = null) 
		{

			if (isset($parameters[0])) {
				$categoryRequired = $parameters[0];
			} else {
				$this->index();
				exit;
			}
			
			$product_categories = array();

			// Use Model for Querie
			$this->useModel("Categorie");
			$PCModel = new CategorieModel();
			$this->useModel("Produit");
			$PModel = new ProduitModel();

			// Get all product categories data
			$categories = $PCModel->getAllCategories();
			foreach ($categories as $key => $category) {
				$product_categories[$key] = $category;
				
				// IF required category: active
				if ($category["libelle"] == $categoryRequired) {
					$product_categories[$key]["active"] = 1;
				} else {
					$product_categories[$key]["active"] = 0;
				}
					
			}

			$this->set(array(
					"product_categories" => $product_categories,
					"title" => "Catégorie " . $categoryRequired,
					"products" => $PModel->getProductByCategory($categoryRequired)
				));

			// render the view
			$this->render("index");
		}
	}

?>
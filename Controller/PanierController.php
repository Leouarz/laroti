<?php

	/**
	*   Manage panier queries
	*/
	class PanierController extends Controller
	{
		
		/**
		* 	Add a product to cart
		*/
		public function ajout_panier($parameters) 
		{
			$product_id = $parameters[0];

			// Use Model for Querie
			$this->useModel("Panier");
			$PanierModel = new PanierModel();

			echo $PanierModel->ajout_panier($product_id);
		}

		/**
		* 	Return panier content API
		*/
		public function get_panier() 
		{
			echo $this->_get_panier();
		}

		/**
		* 	Return panier content
		*/
		public function _get_panier() 
		{
			// Use Model for Querie
			$this->useModel("Panier");
			$PanierModel = new PanierModel();
			
			return $PanierModel->get_panier();
		}
                
        /**
        * 	Drop item from cart
        */
        public function drop_panier($parameters) 
        {
        	$product_id = $parameters[0];

        	// Use Model for Querie
			$this->useModel("Panier");
			$PanierModel = new PanierModel();

			echo $PanierModel->drop_panier($product_id);
        }
                
        /**
        * 	Drop all from cart
        */
        public function drop_all_panier() 
        {
        	// Use Model for Querie
			$this->useModel("Panier");
			$PanierModel = new PanierModel();

			echo $PanierModel->drop_all_panier();
        }
	}

?>
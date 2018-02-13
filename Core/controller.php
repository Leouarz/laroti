<?php

	/**
	*    The CTRLR Mother is here !
	*/
	class Controller
	{
		
		private $VARS = array();
		private $LAYOUT = "default";

		/**
		* 	SET a variable
		*/
		public function set($var) 
		{
			$this->VARS = array_merge($this->VARS, $var);
		}

		/**
		* 	SET the layout
		*/
		public function setLayout($var) 
		{
			$this->LAYOUT = $var;
		}		

		/**
		* 	Render a View
		*/
		public function render($filename) 
		{
			// GET variables
			extract($this->VARS);

			// Wait for Output
			ob_start();

			// Include the view
			require(WEBROOT."/View/".str_replace("Controller", "", get_class($this))."/".$filename.".php");

			// Equal the included view content
			$layout_content = ob_get_clean();
			
			// IF NO Layout
			if ($this->LAYOUT == false) {
				echo $layout_content;
			} else {
				require(WEBROOT."/View/layout/".$this->LAYOUT.".php");
			}
		}

		/**
		* 	Use Required Model
		*/
		public function UseModel($modelName) 
		{
			require_once(WEBROOT."Model/".$modelName."Model.php");
		}

		/**
		* 	Use Required Controller
		*/
		public function UseController($controllerName) 
		{
			require_once(WEBROOT."Controller/".$controllerName."Controller.php");
		}	
	}

?>
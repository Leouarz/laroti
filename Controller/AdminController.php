<?php

	/**
	* 	Manage admin views
	*/
	class AdminController extends Controller
	{
		/*
		*	On construct, check if admin user
		*/
		function __construct()
		{
			$this->useController("session");
			$sessionController = new SessionController();

			if (!$sessionController->isConnected() || !$sessionController->isAdmin()) {
				// IS NOT admin --> render home
				$this->useController("home");
				$homeController = new HomeController();

				$homeController->index();
				exit;
			}
		}

		function index()
		{
			$this->setLayout("admin");
			$this->render("index");
		}

		/**
		* 	render product overview
		*/
		public function product() 
		{
			
		}

		/*
		*	Render command overview
		*/
		function commande()
		{
			// 1- Get unfinished commands
			$this->useController("commande");
			$commandeController = new CommandeController();

			$unfinished_commands = $commandeController->getUnfinishedCommands();

			$this->set(array(
				"command_data" => $unfinished_commands
			));

			$this->setLayout("admin");
			$this->render("commande");
		}
	}

?>
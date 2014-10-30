<?php

class Bootstrap
{
	function __construct()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null ;// Als er een url is - zo niet zet dan op 0.
		$url = rtrim($url, '/');	// Laatste "/"" weghalen zodat ie niet in de war komt
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url); // Zorgen voor "controller/method"

		//print_r($url);

		if(empty($url[0]))	// Als er geen pagina is goto index
		{
			require 'controllers/index.php'; 
			$controller = new Index();
			$controller->Index();
			return false;
		}

		$file = 'controllers/' . $url[0] . '.php'; // Check als de controller er is
		if (file_exists($file))
		{
			require $file;							// Zoja gebruik bestand
		}
		else
		{
			require 'controllers/error.php';		// Zo niet geef error
			$controller = new Error();
			return false;
		}
		
		$controller = new $url[0];
		$controller->loadModel($url[0]);

		// Methods aanroepen
		if (isset($url[2]))		// Als de method (functie) er is
		{
			if(method_exists($controller, $url[1]))
			{
				$controller->{$url[1]}($url[2]);
			}
			else
			{
				$this->error();
			}
		}
		else
		{
			if (isset($url[1])) // Als de controller er is
			{
				if(method_exists($controller, $url[1]))
				{
					$controller->{$url[1]}();
				}
				else
				{
					$this->error();
				}
			}
			else
			{
				$controller->Index();
			}
		}
	}

	function error() {
		require 'controllers/error.php';
		$controller = new Error();
		$controller->index();
		return false;
	}
}
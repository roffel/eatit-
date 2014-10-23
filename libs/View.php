<?php

class View
{
	function __construct()
	{
		//echo 'this is the view';
	}

	public function render($name, $clean = false)
	{
		// Met clean wordt er geen footer en header ingeladen
		if($clean == true)
		{
			require 'views/' . $name . '.php';
		}
		else
		{
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';
		}
	}

}
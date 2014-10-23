<?php
class Controller
{
	function __construct()
	{
		//echo 'Main controller<br />';
		// Dit is de main controller en regelt de views!
		$this->view = new View();
	}
}
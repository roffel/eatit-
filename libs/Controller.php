<?php
class Controller
{
	function __construct()
	{
		//echo 'Main controller<br />';
		// Dit is de main controller en regelt de views!
		$this->view = new View();
	}

	public function loadModel($name)
	{
		$path = 'models/'.$name.'_model.php';

		// Checken als de model er is
		if(file_exists($path))
		{
			require 'models/'.$name.'_model.php';
			$modelName = $name . '_Model';
			$this->model = new $modelName;
		}
	}
}
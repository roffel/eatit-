<?php

class Error extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->msg = 'Deze pagina bestaat niet';
		$this->view->render('error/index');
	}
}
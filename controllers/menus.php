<?php

class Menus extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->data = $this->model->getall();
		$this->view->render('menus/index');
	}

	public function details()
	{
		$this->view->data = $this->model->getbyid(1);
		$this->view->render('menus/details');
		var_dump($_GET);
	}
}
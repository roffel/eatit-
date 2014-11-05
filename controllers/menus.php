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

	public function details($id)
	{
		$this->view->data = $this->model->getbyid($id);
		$this->view->render('menus/details');
	}

	public function daghap()
	{
		$this->view->text = $this->model->getdaghap();
		$this->view->render('index/page', true);
	}
}
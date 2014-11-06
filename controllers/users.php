<?php
class Users extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{	
		$this->view->data = $this->model->getall();
		$this->view->render('users/all');
	}

	function details($klantnr)
	{	
		$this->view->data = $this->model->details($klantnr);
		$this->view->render('users/details');
	}
}
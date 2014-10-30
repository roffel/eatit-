<?php

class Orders extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{	
		$this->view->data = $this->model->getneworder();
		$this->view->render('orders/new');
	}

	function addtoorder($order)
	{
		// $id = het nummer van 't product
		// $kind = gerecht of drank
		$this->model->addtoorder($order);
	}
}
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

	function add()
	{	
		$this->view->data = $this->model->addorder();
		$this->view->render('orders/add');
	}

	function all()
	{	
		$this->view->data = $this->model->getall();
		$this->view->render('orders/all');
	}

	public function details($id)
	{
		$this->view->data = $this->model->getbyid($id);
		$this->view->render('orders/details');
	}
}
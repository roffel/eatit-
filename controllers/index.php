<?php

class Index extends Controller
{
	function __construct()
	{
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
	}

	function index()
	{	
		$this->view->render('index/index');
	}

	function over()
	{	
		$this->view->text = "Over";
		$this->view->render('index/page');
	}

	function contact()
	{	
		$this->view->text = "Contact";
		$this->view->render('index/page');
	}
}
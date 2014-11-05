<?php

class Login extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{	
		$this->view->render('login/index');
	}

	function run()
	{
		$this->model->run();
	}

	function register()
	{
		$this->view->text = $this->model->register();
		$this->view->render('login/register');
	}

	function activate($email)
	{
		$this->view->text = $this->model->activate($email);
		$this->view->render('index/page');
	}
}
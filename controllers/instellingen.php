<?php

class Instellingen extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{	
		$this->view->data = $this->model->getsettings();
		$this->view->render('instellingen/index');
	}

	function opslaan()
	{	
		$this->view->melding = $this->model->savesettings();
		$this->view->data = $this->model->getsettings();
		$this->view->render('instellingen/index');
	}
}
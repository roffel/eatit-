<?php

class Orders_Model extends Model 
{ 			 // Business logic
	function __construct()
	{
		parent::__construct();
	}

	function addtoorder($order)
	{
		Session::init();
		if (Session::get('basket'))
		{
			echo "session!!!";
			$order 		= explode('-',$order);
			$menuid		= $order[0];
			$kind		= $order[1];
			$_SESSION['basket'][] = array($menuid, $kind);
			echo "<pre>";
			print_r($_SESSION['basket']);
			echo "</pre>";
		}
		else
		{
			Session::set('basket',true);
			$_SESSION['basket'] = array();	
			$_SESSION['basket'][] = 'basket';
			echo "No Session";
			print_r($_SESSION['basket']);
		}
	}

	function getneworder()
	{

		Session::init();
		//S
		$data = $_SESSION;
		return $data;
	}
}
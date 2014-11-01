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
			$order 		= explode('-',$order);
			$menuid		= $order[0];
			$kind		= $order[1];
			foreach($_SESSION['basket'] as $key=>$basket)
			{
				if (in_array($menuid, $basket))
				{	// Als het er al wel in staat
	    			//echo "<script>alert('In array');</script>";
	    			$_SESSION['basket'][$key]['aantal']++;
				}
				else // Als nog niet in winkelwagen
				{
					$_SESSION['basket'][] = array("menunr" => $menuid, "soort" => $kind, "aantal" => '1');
				}
			}
		}
		else
		{
			Session::set('basket',true);
			$_SESSION['basket'] = array();	
			$order 		= explode('-',$order);
			$menuid		= $order[0];
			$kind		= $order[1];
			$_SESSION['basket'][] = array("menunr" => $menuid, "soort" => $kind, "aantal" => '1');
		}
		header('location: ../');
	}

	function getneworder()
	{
		//Session::destroy();
		Session::init();
		$data = $_SESSION['basket'];
		$orderlist = array();
		$subtotaal = 0;
		foreach($data as $orderregel)
		{
			$details = $this->db->select('
			SELECT 
				*
			FROM Menu
			WHERE Menu.menunr = :id'
			, array(':id' => $orderregel['menunr']));
			$totaal = 0 + ($details[0]['prijs'] * $orderregel['aantal']);
			$orderlist[] = array(
				"menunr"	=> $orderregel['menunr'],
				"soort"		=> $orderregel['soort'],
				"aantal"	=> $orderregel['aantal'],
				"naam"		=> $details[0]['naam'],
				"prijs"		=> $details[0]['prijs'],
				"totaal"	=> $totaal
			);
			$subtotaal = $subtotaal + ($details[0]['prijs'] * $orderregel['aantal']);
		}
		$orderlist["subtotaal"] = $subtotaal;
		return $orderlist;
	}
}
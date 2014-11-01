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
			$menunr		= $order[0];
			$kind		= $order[1];
			$idx		= -1;
			
			foreach($_SESSION['basket'] as $i => $basketItems)
			{
				if($basketItems['menunr'] == $menunr && $basketItems['soort'] == $kind)
				{
					$idx = $i;
					break;
				}
			}
			if ($idx == -1)
			{
				// Als ze nog niet in de kar zitten
				$_SESSION['basket'][] = array(
					"menunr" => $menunr,
					"soort" => $kind,
					"aantal" => 1
				);
			}
			else
			{
				$_SESSION['basket'][$idx]['aantal']++;
			}
		}
		else
		{
			Session::set('basket',true);
			$_SESSION['basket'] = array();	
			$order 		= explode('-',$order);
			$menunr		= $order[0];
			$kind		= $order[1];
			$_SESSION['basket'][] = array("menunr" => $menunr, "soort" => $kind, "aantal" => '1');
		}
		header('location: ../');
	}

	function getneworder()
	{
		Session::init();
		if(isset($_SESSION['basket']))
		{
			$data = $_SESSION['basket'];
		}
		else
		{
			$data = array();
		}
		$orderlist = array();
		$subtotaal = 0;
		foreach($data as $orderregel)
		{
			$soort = $orderregel['soort'];

			if($soort == "menu")
			{
				$details = $this->db->select('
				SELECT 
					*
				FROM Menu
				WHERE Menu.menunr = :id'
				, array(':id' => $orderregel['menunr']));
			}
			if($soort == "side")
			{
				$details = $this->db->select('
				SELECT 
					*
				FROM Drank
				WHERE Drank.dranknr = :id'
				, array(':id' => $orderregel['menunr']));
			}


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
		$orderlist["dranken"] = $this->db->select('SELECT * FROM Drank');
		$orderlist["subtotaal"] = $subtotaal;
		return $orderlist;
	}

	public function addorder()
	{

	}
}
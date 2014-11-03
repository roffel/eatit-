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

	function addorder()
	{
		SESSION::init();
		if(isset($_SESSION['basket']))
		{
			$data = $_SESSION['basket'];
		
			$orderlist = array();
			$subtotaal = 0;
			$klantdata = $this->db->select('SELECT `klantnr` FROM Klant');
			$klantnr = $klantdata[0]['klantnr'];

			$table = 'Order';
			$sth = $this->db->prepare("INSERT INTO `Order` (klantnr)
			    VALUES(:klantnr)");
			$sth->execute(array(
			    "klantnr" => $klantnr
			));

			$ordernr = $this->db->lastInsertId();
			
			foreach($data as $orderregel)
			{
				$soort   = $orderregel['soort'];
				$menunr  = $orderregel['menunr'];
				echo $soort;
				if($soort == 'side')
				{
					echo "Hier komt ie";
					$this->db->insert('Orderregel', array(
						'ordernr'	=> $ordernr,
						'dranknr'	=> $menunr
					));
				}
				if($soort == 'menu')
				{
					$this->db->insert('Orderregel', array(
						'ordernr'	=> $ordernr,
						'menunr'	=> $menunr
					));	
				}
			}
		}
		else
		{
			header('Location: ../../');
		}	
	}

	function getall()
	{
		SESSION::init();
		if($_SESSION['user']['rang'] == 'admin')
		{
			$data = $this->db->select('SELECT * FROM  `Order` JOIN `Klant` ON (`Klant`.`klantnr` = `Order`.`klantnr`) ORDER BY `Order`.`tijd` ASC');
			return $data;
		}
		else
		{
			header('location: '.URL);
		}
	}

	function getbyid($id)
	{
		SESSION::init();
		$orderregels = $this->db->select('
			SELECT * FROM  `Order`
			JOIN `Klant` ON (`Klant`.`klantnr` = `Order`.`klantnr`)
			JOIN `Orderregel` ON (`Order`.`Ordernr` = `Orderregel`.`Ordernr`)
			WHERE `Orderregel`.`Ordernr` = :ordernr'
			, array(':ordernr' => $id)
			);


		$data = array();
		$data["ordernr"] = $orderregels[0]["ordernr"];
		$data["klant"] = array();
		$data["klant"]["voornaam"] = $orderregels[0]["voornaam"];
		$data["klant"]["tussenvoegsel"] = $orderregels[0]["tussenvoegsel"];
		$data["klant"]["achternaam"] = $orderregels[0]["achternaam"];
		$data["klant"]["adres"] = $orderregels[0]["adres"];
		$data["klant"]["postcode"] = $orderregels[0]["postcode"];
		$data["klant"]["woonplaats"] = $orderregels[0]["woonplaats"];
		$data["status"] = $orderregels[0]['status'];
		$data["tijd"] = $orderregels[0]['tijd'];
		$data["orderregels"] = array();


		foreach($orderregels as $orderregel)
		{
			if($orderregel['menunr'] != "")
			{
				$menu = $this->db->select('SELECT `naam` FROM `Menu` WHERE `Menu`.`menunr` = :menunr'
				, array(':menunr' => $orderregel['menunr']));
		
				$menu = $menu[0]['naam'];
				$side = "";
			}
			else
			{
				$side = $this->db->select('SELECT `naam` FROM `Drank` WHERE `Drank`.`dranknr` = :dranknr'
				, array(':dranknr' => $orderregel['dranknr']));
		
				$menu = "";
				$side = $side[0]['naam'];
			}
			$data['orderregels'][] = 
				array(
					"menu" 	=> $menu,
					"side"	=> $side
				);
		}
		return $data;	
	}
}
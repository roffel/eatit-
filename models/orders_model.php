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
				// Wel in de kar? +1!
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
				$aantal  = $orderregel['aantal'];
				if($soort == 'side')
				{
					$drankdata = $this->db->select('SELECT * FROM `Drank` WHERE `Dranknr` = :dranknr'
					, array(':dranknr' => $menunr));
					
					// Wat gaat er af in de inhoud bij dranken?
					$min = $drankdata[0]['hoeveelheid'] * $orderregel['aantal'];
					$this->db->update('`Drank`', array(
						'voorraad' => $drankdata[0]["voorraad"] - $min
					)
					, "dranknr = '".$menunr."'"
					);

					$this->db->insert('Orderregel', array(
						'ordernr'	=> $ordernr,
						'dranknr'	=> $menunr,
						'aantal'	=> $aantal
					));
				}
				if($soort == 'menu')
				{
					$this->db->insert('Orderregel', array(
						'ordernr'	=> $ordernr,
						'menunr'	=> $menunr,
						'aantal'  	=> $aantal
					));	
				}
			}
			$data = $this->db->select('SELECT * FROM `Klant` WHERE `Klant`.`email` = :email'
			, array(':email' => $_SESSION['user']['email']));
			return $data;
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
		if(isset($_POST['editstatus']))
		{
			$status = $_POST['editstatus'];
			$this->db->update('`Order`', array(
				'status' => $status
				)
				, "ordernr = '".$id."'"
			);
		}
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
		$data["subtotaal"] = 0;
 
		foreach($orderregels as $orderregel)
		{
			if($orderregel['menunr'] != "")
			{
				$menudata = $this->db->select('SELECT `naam`, `prijs` FROM `Menu` WHERE `Menu`.`menunr` = :menunr'
				, array(':menunr' => $orderregel['menunr']));

				$menu  = $menudata[0]['naam'];
				$side  = "";
				$prijs = $menudata[0]['prijs'];
			}
			else
			{
				$sidedata = $this->db->select('SELECT `naam`, `prijs` FROM `Drank` WHERE `Drank`.`dranknr` = :dranknr'
				, array(':dranknr' => $orderregel['dranknr']));
		
				$menu = "";
				$side = $sidedata[0]['naam'];
				$prijs = $sidedata[0]['prijs'];
			}
			$data['orderregels'][] = 
				array(
					"menu" 	=> $menu,
					"side"	=> $side,
					"prijs" => $prijs
				);
			$data["subtotaal"] =  $data["subtotaal"] + $prijs;		
		}
		return $data;	
	}
}
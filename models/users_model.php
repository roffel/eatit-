<?php
class Users_Model extends Model 
{ 	
	function __construct()
	{
		parent::__construct();
		Session::init();
		if($_SESSION['user']['rang'] != "admin")
		{
			header('Location: '.URL.'index');
			exit;
		}
	}
	
	function getall()
	{
		$data = $this->db->select('SELECT * FROM Klant');
		return $data;
	}

	function details($klantnr)
	{
		$data = $this->db->select('SELECT * FROM Klant WHERE klantnr = :klantnr', array(':klantnr' => $klantnr));
		return $data;
	}
}
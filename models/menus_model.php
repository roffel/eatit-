<?php

class Menus_Model extends Model 
{ 			 // Business logic
	function __construct()
	{
		parent::__construct();
	}

	function getall()
	{
		$sth = $this->db->prepare("SELECT * FROM menus WHERE actief = 1");
		$sth->execute();

		$data 	= $sth->fetchAll();
		return $data;
	}

	function getbyid($id)
	{
		$sth = $this->db->prepare("SELECT * FROM menus WHERE id = :id");
		$sth->execute(array(
			':id' 	=> $id
		));

		$data 	= $sth->fetchAll();
		return $data;
	}
}
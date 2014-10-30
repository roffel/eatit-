<?php

class Menus_Model extends Model 
{ 			 // Business logic
	function __construct()
	{
		parent::__construct();
	}

	function getall()
	{
		$data = $this->db->select('SELECT * FROM menus WHERE actief = :actief', array(':actief' => 1));
		return $data;
	}

	function getbyid($id)
	{
		$data = $this->db->select('SELECT * FROM menus WHERE id = :id', array(':id' => $id));
		$data[0]['gerechten'] = array(); 
		$data[0]['ingredienten'] = array();

		$gerechten = $this->db->select('
			SELECT 
				gerechten.naam,
				gerechten.omschrijving,
				gerechten.id
			FROM gerechtenopmenu
			JOIN gerechten on gerechtenopmenu.gerechtnummer = gerechten.id
			JOIN menus on gerechtenopmenu.menunummer = menus.id
			WHERE gerechtenopmenu.menunummer = :id'
			, array(':id' => $id));

		$sth = $this->db->prepare("
			SELECT ingredienten.naam, ingredienten.id
			FROM ingredienteningerechten
			JOIN gerechten ON ingredienteningerechten.gerechtid = gerechten.id
			JOIN ingredienten ON ingredienteningerechten.ingredientid = ingredienten.id
			JOIN gerechtenopmenu ON gerechtenopmenu.gerechtnummer = gerechten.id
			JOIN menus ON menus.id = gerechtenopmenu.menunummer
			WHERE menus.id = ".$id."
		");

		$ingredienten = $this->db->select('
			SELECT ingredienten.naam, ingredienten.id
			FROM ingredienteningerechten
			JOIN gerechten ON ingredienteningerechten.gerechtid = gerechten.id
			JOIN ingredienten ON ingredienteningerechten.ingredientid = ingredienten.id
			JOIN gerechtenopmenu ON gerechtenopmenu.gerechtnummer = gerechten.id
			JOIN menus ON menus.id = gerechtenopmenu.menunummer
			WHERE menus.id = :id'
			, array(':id' => $id));
		$data[0]['gerechten'] = $gerechten;
		$data[0]['ingredienten'] = $ingredienten;

		return $data;
	}
}
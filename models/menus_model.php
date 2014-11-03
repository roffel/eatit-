<?php
class Menus_Model extends Model 
{ 			 // Business logic
	function __construct()
	{
		parent::__construct();
		Session::init();
	}

	function getall()
	{
		$data = $this->db->select('SELECT * FROM Menu WHERE actief = :actief', array(':actief' => 'ja'));
		return $data;
	}

	function getbyid($id)
	{
		$data = $this->db->select('SELECT * FROM Menu WHERE menunr = :id', array(':id' => $id));
		$data[0]['gerechten'] = array(); 
		$data[0]['ingredienten'] = array();

		$gerechten = $this->db->select('
			SELECT 
				Gerecht.naam,
				Gerecht.omschrijving,
				Gerecht.gerechtnr
			FROM Gerechtmenu
			JOIN Gerecht on Gerechtmenu.gerechtnr = Gerecht.gerechtnr
			JOIN Menu on Gerechtmenu.menunr = Menu.menunr
			WHERE Gerechtmenu.menunr = :id'
			, array(':id' => $id));

		$ingredienten = $this->db->select('
			SELECT Ingredient.naam, Ingredient.ingredientnr
			FROM Ingredientgerecht
			JOIN Gerecht ON Ingredientgerecht.gerechtnr = Gerecht.gerechtnr
			JOIN Ingredient ON Ingredientgerecht.ingredientnr = Ingredient.ingredientnr
			JOIN Gerechtmenu ON Gerechtmenu.gerechtnr = Gerecht.gerechtnr
			JOIN Menu ON Menu.menunr = Gerechtmenu.menunr
			WHERE Menu.menunr = :id'
			, array(':id' => $id));
		$data[0]['gerechten'] = $gerechten;
		$data[0]['ingredienten'] = $ingredienten;

		return $data;
	}
}
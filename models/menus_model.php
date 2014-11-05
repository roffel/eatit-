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
			SELECT Ingredient.naam, Ingredient.ingredientnr, Ingredientgerecht.hoeveelheid
			FROM Ingredientgerecht
			JOIN Gerecht ON Ingredientgerecht.gerechtnr = Gerecht.gerechtnr
			JOIN Ingredient ON Ingredientgerecht.ingredientnr = Ingredient.ingredientnr
			JOIN Gerechtmenu ON Gerechtmenu.gerechtnr = Gerecht.gerechtnr
			JOIN Menu ON Menu.menunr = Gerechtmenu.menunr
			WHERE Menu.menunr = :id'
			, array(':id' => $id));
		$data[0]['gerechten'] = $gerechten;
		$data[0]['ingredienten'] = $ingredienten;
		/* ----------- */
		$ingredienten = $this->db->select('
			SELECT Ingredient.naam, Ingredient.ingredientnr, Ingredientgerecht.hoeveelheid
			FROM Ingredientgerecht
			JOIN Gerecht ON Ingredientgerecht.gerechtnr = Gerecht.gerechtnr
			JOIN Ingredient ON Ingredientgerecht.ingredientnr = Ingredient.ingredientnr
			JOIN Gerechtmenu ON Gerechtmenu.gerechtnr = Gerecht.gerechtnr
			JOIN Menu ON Menu.menunr = Gerechtmenu.menunr
			WHERE Menu.menunr = :id'
			, array(':id' => $id));
		foreach($ingredienten as $ingredient)
		{
			$voorraad = $this->db->select('
			SELECT Ingredient.naam, Ingredient.ingredientnr, Ingredient.hoeveelheid as voorraad
			FROM Ingredient
			WHERE Ingredient.ingredientnr = :id'
			, array(':id' => $ingredient['ingredientnr']));

			$hoeveelheid = $this->db->select('
			SELECT Ingredient.naam, Ingredient.ingredientnr, Ingredientgerecht.hoeveelheid
			FROM Ingredientgerecht
			JOIN Gerecht ON Ingredientgerecht.gerechtnr = Gerecht.gerechtnr
			JOIN Ingredient ON Ingredientgerecht.ingredientnr = Ingredient.ingredientnr
			WHERE Ingredient.ingredientnr = :id'
			, array(':id' => $ingredient['ingredientnr']));
			// Hoeveel is er nodig?
			$hoeveelheid = $hoeveelheid[0]['hoeveelheid'];
			// Wat is de voorraad?
			$voorraad = $voorraad[0]['voorraad'];
			// Beschikbaar = Wat er is - wat je nodig bent.
			$beschikbaar = $voorraad - $hoeveelheid;
			// Klap dat in 'n array met als iets beschikbaar is
			$beschikbaarheidchk = array();
			if($beschikbaar <= 0)
			{
				$beschikbaarheidchk[] = '0';
			}
			else
			{
				$beschikbaarheidchk[] = '1';
			}
			// Check als iets niet beschikbaar is, geef error
			if (in_array("0", $beschikbaarheidchk)) {
				$data[0]['beschikbaar'] = 0;
			}
			else
			{
				$data[0]['beschikbaar'] = 1;
			}
		}
		return $data;
	}

	function getdaghap()
	{
		echo "bla";
	}
}
<?php
class instellingen_Model extends Model 
{ 			 // Business logic
	function __construct()
	{
		parent::__construct();
		Session::init();
	}

	function getsettings()
	{
		$data = $this->db->select('SELECT * FROM Klant WHERE email = :email', array(':email' => $_SESSION['user']['email']));
		return $data;
	}

	function savesettings()
	{
		if(isset($_POST['voornaam']))
		{
			$this->db->update('Klant',
				array(
					'voornaam'		=> $_POST['voornaam'],
					'tussenvoegsel' => $_POST['tussenvoegsel'],
					'achternaam'	=> $_POST['achternaam'],
					'adres'			=> $_POST['adres'],
					'postcode'		=> $_POST['postcode'],
					'telefoon'		=> $_POST['telefoon'],
					'woonplaats'	=> $_POST['woonplaats']
				)
				, "`email` = '".$_SESSION['user']['email']."'"
			);
			if($_POST['wachtwoord'] != "")
			{
				$this->db->update('Gebruiker',
					array(
						'password' => $_POST['wachtwoord']
					)
					, "`email` = '".$_SESSION['user']['email']."'"
				);
			}
			$melding = 'Opgeslagen!';
		}
		else
		{
			$melding = 'Huh geen post, hoe doe je dit?';
		}
		return $melding;
	}
}
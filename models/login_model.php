<?php
class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		// sth = statement handler
		$sth = $this->db->prepare("SELECT email, rang FROM Gebruiker WHERE
			email = :email AND password = :password AND actief = :actief");
		$sth->execute(array(
			':email' 	=> $_POST['email'],
			':password' => $_POST['password'],
			':actief'	=> 'ja'
		));
		$data 	= $sth->fetchAll();

		$count 	=  $sth->rowCount();
		if($count > 0)
		{
			Session::init();
			Session::set('loggedIn', true);
			$_SESSION['user'] = array();
			$_SESSION['user']['email'] 	= $data[0]['email'];
			$_SESSION['user']['rang'] 	= $data[0]['rang'];
			header('location: ../dashboard');
		}
		else
		{
			header('location: ../login?error=Gegevens%20zijn%20onjuist%20of%20het%20account%20is%20nog%20niet%20geactiveerd.');
		}
	}

	public function register()
	{
		if(isset($_POST['voornaam']))
		{
			$sth = $this->db->prepare("SELECT email FROM Gebruiker WHERE
			email = :email");
			$sth->execute(array(
				':email' 	=> $_POST['email']
			));
			$data 	= $sth->fetchAll();

			$count 	=  $sth->rowCount();
			if($count > 0)
			{
				$text = "<div class=\"error\">Er bestaat al een account met de e-mailadres.</div>";
			}
			else
			{
				if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
				{
					$password = substr(strrev(md5($_POST['voornaam']."supervet".$_POST['straat'])),3,8);
					$this->db->insert('Gebruiker', array(
						'password' 		=> $password,
						'email'			=> $_POST['email']
					));

					$this->db->insert('Klant', array(
						'achternaam' 	=> ucfirst($_POST['achternaam']),
						'tussenvoegsel' => strtolower($_POST['tussenvoegsel']),
						'voornaam'		=> ucfirst($_POST['voornaam']),
						'adres'			=> ucfirst($_POST['straat'])." ".$_POST['huisnummer'],
						'postcode'		=> strtoupper($_POST['postcode']),
						'woonplaats'	=> ucfirst($_POST['woonplaats']),
						'email'			=> $_POST['email'],
					));

					$email = "<div class=\"succes\">Uw registratie bij EatIT is gelukt! U kunt inloggen met ".$password." nadat u uw account heeft geactiveerd via deze <a href=\"".URL."login/activate/".$_POST['email']."\">link.</div>";
					$email .= "<script>$(document).ready( function(){ $('#regform').hide(); $('h1').hide();});</script>";
					//mail($_POST['email'], 'Registratie EatIT', $email);
					$text = $email;
				}
				else
				{
					$text = "<div class=\"error\">".$_POST['email']." is geen geldig e-mailadres.</div>";
				}
			}
			return $text;
		}
		else
		{
			$text = "";
		}
	}

	public function activate($email)
	{
		$sth = $this->db->prepare("SELECT `email` FROM `Gebruiker` WHERE
			email = :email AND actief = :actief");
		$sth->execute(array(
			':email' 	=> $email,
			':actief'	=> 'nee'
		));
		
		$data 	= $sth->fetchAll();

		$count 	=  $sth->rowCount();
		if($count > 0)
		{
			$this->db->update('`Gebruiker`', array(
				'actief' => 'ja'
				)
				, "email = '".$email."'"
			);
			$text = "<h1>Gelukt!</h1>".$email." is geactiveerd! Inloggen kan <a href=\"".URL."/login\" title=\"Inloggen\">hier</a>.<br /><br /><br /><br /><br /><br /><br />";
		}
		else
		{
			$text = "Het account ".$email." is al geactiveerd of bestaat helemaal niet.";
		}
		return $text;
	}
}
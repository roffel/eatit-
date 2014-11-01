<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		// sth = statement
		$sth = $this->db->prepare("SELECT email, rang FROM Gebruiker WHERE
			email = :email AND password = :password");
		$sth->execute(array(
			':email' 	=> $_POST['email'],
			':password' => $_POST['password']
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
			if($_SESSION['user']['rang'] == 'gebruiker')
			{
				/* Hier moet het klantnummer opgehaald worden en aan de sessie gehangen worden */
			}
			header('location: ../dashboard');
		}
		else
		{
			header('location: ../login');
		}
	}
}
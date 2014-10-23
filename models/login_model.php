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
		$sth = $this->db->prepare("SELECT id FROM klanten WHERE
			email = :email AND wachtwoord = :password");
		$sth->execute(array(
			':email' 	=> $_POST['email'],
			':password' => $_POST['wachtwoord']
		));

		//$data 	= $sth->fetchAll();
		$count 	=  $sth->rowCount();
		echo $count;
		if($count > 0)
		{
			Session::init();
			Session::set('loggedIn', true);
			header('location: ../dashboard');
		}
		else
		{
			header('location: ../login');
		}

		print_r($data);
	}
}
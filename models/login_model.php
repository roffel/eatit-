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
		$sth = $this->db->prepare("SELECT klantnummer FROM klanten WHERE
			email = :email AND code = :code");
		$sth->execute(array(
			':email' 	=> $_POST['email'],
			':code' => $_POST['code']
		));
		$data 	= $sth->fetchAll();
		$count 	=  $sth->rowCount();
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
	}
}
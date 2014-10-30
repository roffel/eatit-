<?php
// Deze class breidt de PHP PDO klasse uit
class Database extends PDO
{
	public function __construct()
	{
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
	}

	// Sth = statement handler
	/**
	* select
	* @param string $sql Een SQL string
	* @param array $array voor de parameters
	* @param constant $fetchMode PDO ophaal modus. Standaard is assoc
	* @return mixed
	* Gebruiken als $this->db->select('SELECT * FROM menus');
	* OF MET WHERE als $this->db->select('SELECT * FROM menus WHERE id = :id', array(':id' => $id));
	*/
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$sth = $this->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue("$key", $value);
		}
		
		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}
	/**
	* insert
	* @param string $table De naam van de tabel om data in te plaatsen
	* @param string $data Een associative array
	* Kan gebruikt worden als:
	* $this->db->insert('tabelnaam', array(
	*	'menunaam' => 'Super menu',
	*	'aantal' => '25',
	*	'beschrijving' => 'bla bla bla'
	* ));
	*/

	public function insert($table, $data)
	{
		ksort($data);
		
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		
		foreach ($data as $key => $value)
		{
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}
	
	/**
	* update
	* @param string $table De naam van de tabel om data te updaten
	* @param string $data Een associative array
	* @param string $where het WHERE gedeelte in de query
	* Kan gebruikt worden als:
	* $this->db->update('tabelnaam', array(
	*	'menunaam' => 'Super menu',
	*	'aantal' => '25',
	*	'beschrijving' => 'bla bla bla'
	*  )
	*  , "`id` = {$data['id']}"
	* );
	*/

	public function update($table, $data, $where)
	{
		ksort($data);
		
		$fieldDetails = NULL;

		foreach($data as $key=> $value)
		{
			$fieldDetails .= "`$key`=:$key,";
		}

		$fieldDetails = rtrim($fieldDetails, ','); // Laatste komma weghalen
		
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		
		foreach ($data as $key => $value)
		{
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}

	/**
	* delete
	* 
	* @param string $table
	* @param string $where
	* @param integer $limit
	* @return integer Affected Rows
	*/
	public function delete($table, $where, $limit = 1)
	{
		return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
	}
}
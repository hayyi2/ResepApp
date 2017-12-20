<?php
class Connect
{
	private $pdo;

	function __construct($host, $username, $password, $dbname)
	{
		$pdo = new PDO("mysql:host=$host;dbname=$dbname" , $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false );
		$this->pdo = $pdo;
	}

	public function model($table, $id = false)
	{
		// if (!$id) {
		// 	$single;

		// 	if (substr($table, -2) == "es") {
		// 		$single = substr($table, 0, strlen($table)-2);
		// 	}else if (substr($table, -1) == "s") {
		// 		$single = substr($table, 0, strlen($table)-1);
		// 	}else{
		// 		$single = $table;
		// 	}

		// 	if (substr($single, -1) == "i") {
		// 		$single = substr($single, 0, strlen($single)-1)."y";
		// 	}

		// 	$id = $single . "_id";
		// }
		$id = $table . "_id";
		return new Model($this->pdo, $table, $id);
	}

	public function __call($method, $param)
	{
		$method_class = get_class_methods($this);
		if (!in_array($method, $method_class)) {
			if (isset($param[0])) {
				return $this->model($method, $param[0]);
			}
			return $this->model($method);
		}
	}
}

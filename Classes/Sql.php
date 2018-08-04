<?php 

class Sql extends PDO{

	private $conn;
	
	function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=bdphp7","root","1234");
	}// fim function

	private function setParams($statement, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}

	}// fim setParams

	private function setParam($statement,$key,$value){

			$statement->bindParam($key,$value);

	}// fim setParam

	function query($rawQuery, $params = array()){

		$ps = $this->conn->prepare($rawQuery);

		$this->setParams($ps, $params);

		$ps->execute();

		return $ps;
	}// fim query


	function select($rawQuery, $params = array()):array{

		$ps = $this->query($rawQuery,$params);
		return $ps->fetchAll(PDO::FETCH_ASSOC);


	}// fim select
}




 ?>
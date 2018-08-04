<?php 

class Usuario{
	
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	function getIdusuario(){
		return $this->idusuario;
	}

	function setIdusuario($value){
		$this->idusuario = $value;
	}

	function getDeslogin(){
		return $this->deslogin;
	}

	function setDeslogin($value){
		$this->deslogin = $value;
	}

	function getDessenha(){
		return $this->dessenha;
	}

	function setDessenha($value){
		$this->dessenha = $value;
	}	
	
	function getDtcadastro(){
		return $this->dtcadastro;
	}

	function setDtcadastro($value){
		$this->dtcadastro = $value;
	}


	function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id
	));


		if (count($results)>0) {
			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}// fim loadById


	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")

		));


	}// fim toString


}




?>
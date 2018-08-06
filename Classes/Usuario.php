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

			$this->setData($results[0]);
		
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

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

	}//fim getList

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%" ));

	}//fim search

	function login($login, $password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$login, ":PASSWORD"=>$password
	));


		if (count($results)>0) {
		
			$this->setData($results[0]);

		}else{
				throw new Exception("Login e/ou Senha Inválidos");
		}// fim else

			
	}// fim login

	function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}// fim setData

	function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($results)>0) {
		
			$this->setData($results[0]);

		}else{
				throw new Exception("Login e/ou Senha Inválidos");
		}// fim else

	}// fim insert

	function update($login,$password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
		));



	}// fim update

	function __construct($login = "",$password =""){
		
		$this->setDeslogin($login);
		$this->setDessenha($password);

	}// fim construct



}// fim classe Usuario




?>
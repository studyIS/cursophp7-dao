<?php 

require_once("config.php");

$usuario = new Usuario();

$usuario->loadById(6);

$usuario->delete();

echo $usuario;

/*
	ALTERAR USUARIO
$usuario = new Usuario();
$usuario->loadById(8);
$usuario->update("Professor", "!#$%$")
*/

/*
 CRIANDO UM NOVO USUARIO
$aluno = new Usuario("aluno","@luno");

$aluno->insert();

echo $aluno;
*/

/*CARREGA UM USUARIO PELO LOGIN E SENHA

$usuario = new Usuario();
$usuario->login("Rayara","7477");

echo $usuario;
/*

/*	CARREGA UMA LISTA DE USUARIOS BUSCANDO PELO LOGIN
$search = Usuario::search("R");

echo json_encode($search);
*/

/*
$lista = Usuario::getList();
echo json_encode($lista);


/*
	CARREGA UM USUARIO
$root = new Usuario();

$root->loadById(2);

echo $root;
*/

/*
	CARREGA TODOS USUARIOS
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);

*/
 ?>

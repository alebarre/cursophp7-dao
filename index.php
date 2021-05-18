<?php 

require_once ("config.php");

//Carrega um usuário
//$root = new Usuario();
//$root->loadById(8);

//Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega lista de usuarios buscando pelo login
//$search = Usuario::search("Ed");
//echo json_encode($search);

//Carrega um usuário usando login e senha
$usuario = new Usuario();
$usuario->login("Eduardo", "123Xeduardo");
echo $usuario;


?>
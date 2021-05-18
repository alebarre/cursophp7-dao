<?php 

require_once ("config.php");

//Carrega um usuário
//$root = new Usuario();
//$root->loadById(8);

//Carrega uma lista de usuarios
// $lista = Usuario::getList();
// echo json_encode($lista);

//Carrega lista de usuarios buscando pelo login
//$search = Usuario::search("Ed");
//echo json_encode($search);

//Carrega um usuário usando login e senha
//$usuario = new Usuario();
//$usuario->login("Eduardo", "123Xeduardo");
//echo $usuario;

//Insert de um novousuario
// $aluno = new Usuario("Marlene Mattos", "Mar789");
// $aluno->insert();
// echo $aluno;

//Update de usuário
// $usuario = new Usuario();
// $usuario->loadById(23);
// $usuario->update("Ronnie Von", "150Ronnie");
// echo $usuario;

//Delete de usuario
$usuario = new Usuario();
$usuario->loadById(18);
$usuario->delete();
echo $usuario;

?>
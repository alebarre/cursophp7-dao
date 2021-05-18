<?php 

require_once ("config.php");

$Sql = new Sql();

//$usuarios = $Sql->select("SELECT * FROM tb_usuarios");

///$Sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>5));

echo json_encode($Sql->select("SELECT * FROM tb_usuarios"));

?>
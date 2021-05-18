<?php 

require_once ("config.php");

$root = new Usuario();

$root->loadById(8);

echo $root;

?>
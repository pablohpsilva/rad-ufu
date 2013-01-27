<?php 
require_once(__DIR__.'/src/model/Categoria.php');

$obj = new Categoria();
$obj->setId(1);
$obj->setNome("Categoria");
$aux = $obj->JsonSerialize();
echo json_encode($aux, JSON_PRETTY_PRINT);
?>
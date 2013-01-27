<?php

require_once(__DIR__. '/src/DAO/postgres/ComprovanteDAO.php');
require_once(__DIR__. '/src/DAO/LimparBanco.php');


LimparBanco::limpar();

$dao = new ComprovanteDAO();
$obj = new Comprovante();

$obj->setArquivo("Joao");
$obj->getAtividade("atividade");

$dao->post($obj);

$aux2 = $dao->read("Joao");
echo $aux2->getNome();


$aux3 = $dao->getAll();
if(empty($aux3))
	echo "ERROR";
else
	echo $aux3[0]->getNome();
/*
$obj->setNome("Margarida");
$dao->update($obj);
$aux = $dao->get("Margarida");
echo $aux->getNome();
*/

//$dao->delete("Joao");

?>
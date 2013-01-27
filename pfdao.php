<?php

require_once(__DIR__. '/src/DAO/postgres/ProfessorDAO.php');
require_once(__DIR__. '/src/DAO/LimparBanco.php');


LimparBanco::limpar();

$dao = new ProfessorDAO();
$obj = new Professor();

$obj->setSiape("10021238");
$obj->setAtivo(1);
$obj->setNome("Joao");
$obj->setSobrenome("Silva");
$obj->setUsuario("jotas");
$obj->setSenha("jotas1");

$dao->post($obj);

$aux = $dao->get("10021238");
echo $aux->getSiape();

$aux2 = $dao->read("jotas");
echo $aux2->getSiape();


$aux3 = $dao->getAll();
if(empty($aux3))
	echo "ERROR";
else
	echo $aux3[0]->getSiape();

$obj->setNome("Margarida");
$dao->update($obj);
$aux = $dao->get("10021238");
echo $aux->getNome();

$dao->delete("10021238");

?>
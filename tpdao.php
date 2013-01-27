<?php

require_once(__DIR__. '/src/DAO/postgres/TipoDAO.php');
require_once(__DIR__. '/src/DAO/LimparBanco.php');

//LimparBanco::limpar();

$dao = new TipoDAO();
$obj = new Tipo();

$obj->setCategoria("Joao");
$obj->setDescricao("Descricao");
$obj->setPontuacao(123);
$obj->setPontuacaoReferencia(421);
$obj->setPontuacaoLimite(456);

$dao->post($obj);

$aux = $dao->get(1);
echo $aux->getDescricao();

$aux3 = $dao->getAll();
if(empty($aux3))
	echo "ERROR";
else
	echo $aux3[0]->getDescricao();

$aux->getDescricao("Margarida");
$dao->update($aux);
$aux2 = $dao->get(1);
echo $aux2->getDescricao();

//$dao->delete(1);

?>
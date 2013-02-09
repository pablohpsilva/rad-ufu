<?php

require_once(__DIR__ . "/ProfessorService.php");
require_once(__DIR__ . "/../DAO/LimparBanco.php");

function verificar($input,$what){
	if(is_null($input))
		echo "Erro aqui, manolo! [" . $what . "]<br/>";
	else
		echo "Realizado com sucesso [" . $what . "] <br/>";
}


LimparBanco::limpar();

$service = new ProfessorService();

//$siape, $nome, $sobrenome, $usuario, $senha, $ativo = TRUE
$service->post(11021,"Professor","Fulano","usuario","senha");
$service->post(11041,"Prof","Fula","usu","sen");
$service->post(12021,"Pros","Ful","usuar","se");
verificar($service->search(11021),"search");
verificar($service->searchAll(),"searchAll");

$service->update(11021,"senha","0192931293");
$service->update("usuar","sobrenome","0293");
$service->update("usuar","nome","0293");
$service->update(11021,"ativo","f");

$service->delete(11021);
$service->delete(11041);
$service->delete(12021);
?>
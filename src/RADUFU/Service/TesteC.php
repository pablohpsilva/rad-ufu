<?php
namespace RADUFU\Service;

//use RADUFU\DAO\LimparBanco;

/*
require_once(__DIR__ . "/CategoriaService.php");
require_once(__DIR__ . "/../DAO/LimparBanco.php");
*/
function verificar($input,$what){
	if(is_null($input))
		echo "Erro aqui, manolo! [" . $what . "]<br/>";
	else
		echo "Realizado com sucesso [" . $what . "] <br/>";
}


//LimparBanco::limpar();

$service = new CategoriaService();

//$siape, $nome, $sobrenome, $usuario, $senha, $ativo = TRUE
/*
$service->post("Professor");
$service->post("Prof");
$service->post("Pros");
verificar($service->search(1),"search");
verificar($service->searchAll(),"searchAll");

$service->update(1,"senha");

$service->delete(1);
$service->delete(3);
$service->delete(2);
*/
?>
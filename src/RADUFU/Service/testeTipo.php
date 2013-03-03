<?php
namespace RADUFU\Service;

require_once(__DIR__."/../Autoloader.php");
require_once(__DIR__."/testeCat.php");
require_once(__DIR__."/testeProfessor.php");
require_once(__DIR__."/testeMulti.php");

echo "</br></br></br>";


$service = new TipoService();
$c = new CategoriaService();
$m = new MultiplicadorService();

$service->post($c->search(1),"Descricao1", 54, 30, 60, $m->search(1));


$service->post($c->search(2),"Descricao2", 100, 50, 100, $m->search(2));

//echo $service->search(1)->getDescricao();


//print_r($service->searchAll());

//$service->update(1,"Aulas por dia");
//echo $service->search(1)->getNome();

//$service->delete(1);
//$service->delete(2);

?>
<?php
namespace RADUFU\Service;

require_once(__DIR__."/../Autoloader.php");
require_once(__DIR__."/testeCat.php");

echo "</br></br></br>";


$service = new MultiplicadorService();

$service->post("Aulas por semana");
$service->post("Livros Publicados");

echo $service->search(1)->getNome();
echo $service->search("Livros Publicados")->getNome();


print_r($service->searchAll());

$service->update(1,"Aulas por dia");
echo $service->search(1)->getNome();

//$service->delete(1);
//$service->delete(2);

?>
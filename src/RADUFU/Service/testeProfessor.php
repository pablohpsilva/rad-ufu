<?php
namespace RADUFU\Service;

require_once(__DIR__."/../Autoloader.php");
require_once(__DIR__."/testeCat.php");

echo "</br></br></br>";


$service = new ProfessorService();

$service->post("11021bsi","Nome do Professor1","Senha do Prof. 1");
$service->post("78662bsi","Nome do Professor2","Senha do Prof. 2");

echo $service->search(1)->getSiape();
echo $service->search("78662bsi")->getNome();


print_r($service->searchAll());

$service->update(1,"Fulaninho Locura","SenhaDoFulaninho");
echo $service->search(1)->getNome();

//$service->delete(1);
//$service->delete(2);

?>
<?php
namespace RADUFU\Service;

require_once(__DIR__."/../Autoloader.php");
require_once(__DIR__."/testeCat.php");
require_once(__DIR__."/testeProfessor.php");
require_once(__DIR__."/testeMulti.php");
require_once(__DIR__."/testeTipo.php");
require_once(__DIR__."/testeAtividade.php");

echo "</br></br></br>";

$service = new ComprovanteService();
$a = new AtividadeService();
$p = new ProfessorService();

$service->post(1,"/var/www/images/Screenshot from 2013-02-11 18:11:45.png",1);
$service->post(1,"/var/www/images/Screenshot from 2013-02-18 16:56:34.png",2);

echo $service->search(1)->getArquivo();
print_r($service->searchAll(2));
echo "</br></br>";

print_r($service->searchAll());

echo "</br></br></br>";

print_r($a->searchAll());

//$service->delete(1);
//$service->delete(2);

echo "</br></br>";

print_r($p->searchAll());

echo "</br></br>";

$p->delete(1);

?>
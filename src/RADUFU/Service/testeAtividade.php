<?php
namespace RADUFU\Service;

require_once(__DIR__."/../Autoloader.php");
require_once(__DIR__."/testeCat.php");
require_once(__DIR__."/testeProfessor.php");
require_once(__DIR__."/testeMulti.php");
require_once(__DIR__."/testeTipo.php");

echo "</br></br></br>";


$service = new AtividadeService();
$t = new TipoService();
$p = new ProfessorService();

//public function post($tipo, $descricao, $datainicio, $datafim, $valorMult, $comprovante, $professor, $id = null){

$service->post($t->search(1),'Atividade Descricao1','03/03/2013','04/04/2013',100,null,1);
$service->post($t->search(2),'Atividade Descricao2','01/01/2011','07/07/2011',100,null,2);

echo $service->search(1)->getDescricao();
print_r($service->searchAll(2));
echo "</br></br>";

print_r($service->searchAll());

//public function update($id, $tipo, $descricao, $datainicio, $datafim, $valorMult, $comprovantes, $professor){
$service->update(1,$t->search(1),'NOVINHA ddescricao','03/03/2013','04/04/2013',100,null,1);
echo $service->search(1)->getDescricao();

$service->delete(1);
$service->delete(2);

?>
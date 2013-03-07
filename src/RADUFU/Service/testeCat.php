<?php
namespace RADUFU\Service;

use RADUFU\DAO\LimparBanco;

require_once(__DIR__."/../Autoloader.php");

LimparBanco::limpar();

$service = new CategoriaService();

$service->post("Nome da Categoria Numero1");
$service->post("Nome da Categoria Numero2");

echo $service->search(1)->getNome();
echo $service->search("Nome da Categoria Numero2")->getNome();

print_r($service->searchAll());

$service->update(1,"New Nome da Categoria Numero1");
echo $service->search(1)->getNome();

//$service->delete(1);
//$service->delete(2);

//LimparBanco::limpar();

?>
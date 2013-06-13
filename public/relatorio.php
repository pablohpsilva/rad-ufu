<?php
require_once (__DIR__ . '/../src/RADUFU/Autoloader.php');
use Tonic\Response;

#$config = array(
#    'load' => array('../../src/RADUFU/Resource/*.php')
#);

/**
Mechendo
*/

use RADUFU\Resource\RelatorioResource,
RADUFU\Service\RelatorioService;

#$x = new RelatorioResource();
$z = new RelatorioResource();
#$y = $x->GerarRelatorio(1);
$z->GerarRelatorio(1,'20/2/2010','20/2/2014',"auxiliar",2);
#echo "Ola mundo".$y->getNome();




/*
$app = new Tonic\Application($config);
#echo $app; die;
#var_dump($app); die;

$request = new Tonic\Request();
#echo $request; die;
#var_dump($request); die;

try {
$resource = $app->getResource($request);
#echo $resource; die;
#var_dump($resource); die;

$response = $resource->exec();
} catch (Tonic\NotFoundException $e) {
$response = new Response($e->getCode(), $e->getMessage());

} catch (Tonic\Exception $e) {
$response = new Response($e->getCode(), $e->getMessage());
}

#echo $response; die;
#var_dump($response); die;
$response->output();
*/
?>
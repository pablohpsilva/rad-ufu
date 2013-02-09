<?php
require_once (__DIR__ . '/../../vendor/autoloader.php');

use Tonic\Response;

$config = array(
    'load' => array('../../../src/Resource/*.php')
);

$app = new Tonic\Application($config);
#echo $app; die;
#var_dump($app); die;

$request = new Tonic\Request();
#echo $request; die;
#var_dump($request); die;

try {
    $resource = $app->getResource($request);
    #echo $resource; die;

    $response = $resource->exec();
} catch (Tonic\NotFoundException $e) {
    $response = new Response($e->getCode(), $e->getMessage());

} catch (Tonic\Exception $e) {
    $response = new Response($e->getCode(), $e->getMessage());
}

#echo $response; die;
#var_dump($response); die;
$response->output();

?>

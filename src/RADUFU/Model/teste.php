<?php

namespace RADUFU\Model;

require_once(__DIR__."/../Autoloader.php");

$teste = new Categoria();

$teste->setId(1);
$teste->setNome("cat");

echo $teste->getId();

?>
<?php

    # Usado para carregar os arquivos de acordo com os namespaces (std PSR-0)
    # (https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
    require_once(__DIR__."/../../vendor/composer/ClassLoader.php");

    use Composer\Autoload;

    $loader = new \Composer\Autoload\ClassLoader();
    $loader->add("RADUFU", __DIR__."/../");
    $loader->add("Tonic", __DIR__."/../../vendor/peej/tonic/src/");

    $loader->register();
?>
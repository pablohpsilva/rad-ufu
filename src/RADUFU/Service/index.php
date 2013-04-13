<?php
namespace RADUFU\Service;
use RADUFU\DAO\Exception,
	RADUFU\Model\Professor;

require_once(__DIR__ . '/../Autoloader.php');

session_start();
if (isset($_SESSION['user']))
	echo ($_SESSION['user']->getNome());
else
	echo "nao funciona :(";
?>
<html>
<head></head>
<body></body>
</html>
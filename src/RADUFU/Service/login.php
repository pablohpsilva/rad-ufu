<?php
namespace RADUFU\Service;
use RADUFU\DAO\Exception,
	RADUFU\Model\Professor;

require_once(__DIR__ . '/../Autoloader.php');

$service = new ProfessorService();

if( !is_null($_GET['login']) && !is_null($_GET['senha']) ) {
	$login = $_GET['login'];
	$senha = $_GET['senha'];

	$professor = $service->login($login,$senha);
	if(!is_null($professor))
		print_r($professor->JsonSerialize());
}

//echo $professor->getNome();
//echo $service->searchAll("12129idasdas")->getNome();

?>

<html>
<head></head>
<body>
	<form action="?" method="GET">
		<input type="text" name="login"></input>
		<input type="text" name="senha"></input>
		<input type="submit" name="botao" value="Logar"></input>
		<input type="reset" name="reset" value="Resetar"></input>
	</form>
</body>
</html>
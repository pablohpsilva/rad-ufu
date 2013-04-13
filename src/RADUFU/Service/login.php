<?php
require_once(__DIR__ . '/../Autoloader.php');

use RADUFU\DAO\Exception,
	RADUFU\Model\Professor,
	RADUFU\Service\ProfessorService;

$service = new ProfessorService();

if( isset($_GET['login']) && isset($_GET['senha']) ) {
	$login = $_GET['login'];
	$senha = $_GET['senha'];

	try{
		$professor = $service->login($login,$senha);
		if(!is_null($professor)){
			session_start();
			$_SESSION['user'] = $professor;
			header("Location: index.php");
			exit();
		}
	} catch(Exception $e){
		header("Location: login.php");
		exit();
	}
}

?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>RAD / UFU</title>
<link href="http://twitter.github.io/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
      body {
        padding-top: 10%;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

      .development{
      	margin-top: 20px;
      	margin-bottom: -10px;
      }

    </style>
</head>

<body>
  <div class="container">

      <form class="form-signin" action="?" method="GET">
        <h1 class="form-signin-heading" align="center">RAD / UFU</h1>
        <h3 class="form-signin-heading" align="center">Favor fazer login</h3>
        <input type="text" class="input-block-level" placeholder="Siape" name="login">
        <input type="password" class="input-block-level" placeholder="Senha" name="senha">
        <button class="btn btn-primary" type="submit" name="botao">Logar</button>
        <button class="btn btn-danger btn-primary" type="reset" name="reset">Limpar</button>
        <h5 class="form-signin-heading development" align="justify">Desenvolvido por: <a href="http://www.comppet.ufu.br" target="_blank">CompPET</a></h5>
      </form>

  </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://twitter.github.io/bootstrap/assets/js/jquery.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-transition.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-alert.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-modal.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-scrollspy.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-tab.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-popover.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-button.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-collapse.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-carousel.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-typeahead.js"></script>


</body>

</html>
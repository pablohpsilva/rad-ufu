<?php
require_once(__DIR__.'/Includes.php');
require_once(__DIR__.'/../DAO/LimparBanco.php');

$atividade = new AtividadeService();
$professor = new ProfessorService();
$tipo = new TipoService();
$categoria = new CategoriaService();
$comprovante = new ComprovanteService();
$multiplicador = new MultiplicadorService();

LimparBanco::limpar();

//$nome, $sobrenome, $usuario, $senha
$professor->post(111,"nome professor","sobrenome professor","usuario","senha professor");
//$nome
$categoria->post("categoria Nome");
$categoria->post("categoria Nome 2");
$categoria->update(1,"outro nome");
//$categoria, $descricao, $pontuacao, $pontuacaoreferencia, $pontuacaolimite
$tipo->post(1,"descricao tipo", 10, 2, 30);
$tipo->post(2,"descricao tipo", 10, 2, 30);
//$tipo, $descricao, $datainicio, $datafim, $professor
$atividade->post(1,"2 descricao atividade","10/01/2013","05/01/2013",111);
$atividade->post(1,"descricao atividade","10/01/2013","05/01/2013",111);
$atividade->post(2,"descricao atividade","10/01/2013","05/01/2013",111);
$atividade->update(1,"descricao","atividade descricao atividade");
//$nome, $valor, $limite, $tipo
$multiplicador->post("nome multiplicador",10,500,1);
$multiplicador->update(1,"valor",15);
//$arquivo, $atividade
$comprovante->post("arquivo comprovante",1);
$comprovante->update(1,"arquivo","outro arquivo");

ManipuladorArquivos::hello();
?>
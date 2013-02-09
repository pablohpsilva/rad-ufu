<?php
require_once(__DIR__.'/AtividadeDeEnsino.class.php');

class PontuadorPadrao extends AtividadeDeEnsino {
  // pode ser obra, opera, musical, direcao, 
  // exposicao, direcao, autoria, evento, maquete, 
  // trabalho, resumo, tema, artigo, obra, 
  // aluno, semestre, evento, etc.
  private $quant; 
  private $valor_pontuado;

  function __construct(
    $item_n, $descricao, $data_inicio, $data_fim, $quantidade, $valor){

    parent::__construct($item_n, $descricao, $data_inicio, $data_fim);
    $this->quant               = $quantidade;
    $this->valor_pontuado      = $valor; 
    $this->calculaPontuacao();
  }

  protected function calculaPontuacao() {
    $this->pontuacao = 
        ($this->quant * $this->valor_pontuado);
  }
}
?>
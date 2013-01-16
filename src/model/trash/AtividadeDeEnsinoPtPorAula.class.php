<?php
require_once(__DIR__.'/AtividadeDeEnsino.class.php');

class AtividadeDeEnsinoPtPorAula extends AtividadeDeEnsino {
  private $aulasPorSemana;

  function __construct(
    $item_n, $descricao, $data_inicio, $data_fim, $aulas) {
    
    parent::__construct($item_n, $descricao, $data_inicio, $data_fim);
    $this->aulasPorSemana = $aulas;
    $this->calculaPontuacao();
  }

  protected function calculaPontuacao() {
    $this->pontuacao = 10 * $this->aulasPorSemana;
  }
}
?>
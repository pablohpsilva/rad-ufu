<?php
require_once(__DIR__.'/Atividade.class.php');
/**
 * Representa as Atividades Administrativas e Representações da Resolução
 * CONDIR 02/2007
 */
abstract class AtividadeDeAdmRepresentacoes extends Atividade {

	function __construct($item_n, $descricao, $data_inicio, $data_fim) {
    $this->item_n         = $item_n;
    $this->descricao      = $descricao;
    $this->data_inicio    = $data_inicio;
    $this->data_fim       = $data_fim;
  }  
}
?>
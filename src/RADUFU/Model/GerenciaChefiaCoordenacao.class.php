<?php
require_once(__DIR__.'/AtividadeDeAdmRepresentacoes.class.php');
/**
 * Representa as atividades Administrativas e representações, items 80 a 84
 * da Resolução CONDIR 02/2007
 */
class GerenciaChefiaCoordenacao extends AtividadeDeAdmRepresentacoes {
	private $n_semestres;

	function __construct(
		$item_n, $descricao, $data_inicio, $data_fim, $n_semestres) {

		parent::__construct($item_n, $descricao, $data_inicio, $data_fim);
		$this->n_semestres = $n_semestres;
		$this->calculaPontuacao();
	}

	protected function calculaPontuacao() {
		$this->pontuacao = 5 * $this->n_semestres;
	}
}
?>
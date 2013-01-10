<?php

//namespace model;

class Comprovante{
	private $arquivo;
	private $atividade;

	/* GETTERS */
	public function getArquivo(){ return $this->arquivo;}
	public function getAtividade(){ return $this->atividade;}

	/* SETTERS */
	public function setArquivo($input){$this->arquivo = $input;}
	public function setAtividade($input){$this->atividade = $input;}
}

?>
<?php

//namespace model;

class Tipo{
	private $codigo;
	private $categoria;
	private $descricao;
	private $pontuacao;
	private $pontuacaoreferencia;
	private $pontuacaolimite;

	/* GETTERS */
	public function getCodigo(){ return $this->codigo; }
	public function getCategoria(){ return $this->categoria; }
	public function getDescricao(){ return $this->descricao; }
	public function getPontuacao(){ return $this->pontuacao; }
	public function getPontuacaoReferencia(){ return $this->pontuacaoreferencia; }
	public function getPontuacaoLimite(){ return $this->pontuacaolimite; }

	/* SETTERS */
	public function setCodigo($si){$this->codigo = $si;}
	public function setCategoria($a){$this->categoria = $a;}
	public function setDescricao($n){$this->descricao = $n;}
	public function setPontuacao($sn){$this->pontuacao = $sn;}
	public function setPontuacaoReferencia($u){$this->pontuacaoreferencia = $u;}
	public function setPontuacaoLimite($se){$this->pontuacaolimite = $se;}

}

?>
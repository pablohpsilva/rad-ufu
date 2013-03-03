<?php

namespace RADUFU\Model;

use \JsonSerializable,
	RADUFU\util\LazyDelCollection;

class Tipo implements JsonSerializable{
	private $id;
	private $categoria;
	private $descricao;
	private $pontuacao;
	private $pontuacaoreferencia;
	private $pontuacaolimite;
	private $multiplicador;

	/* GETTERS */
	public function getId(){ return $this->id; }
	public function getCategoria(){ return $this->categoria; }
	public function getDescricao(){ return $this->descricao; }
	public function getPontuacao(){ return $this->pontuacao; }
	public function getPontuacaoReferencia(){ return $this->pontuacaoreferencia; }
	public function getPontuacaoLimite(){ return $this->pontuacaolimite; }
	public function getMultiplicador(){ return $this->multiplicador; }

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setCategoria(Categoria $input){$this->categoria = $input;}
	public function setDescricao($input){$this->descricao = $input;}
	public function setPontuacao($input){$this->pontuacao = $input;}
	public function setPontuacaoReferencia($input){$this->pontuacaoreferencia = $input;}
	public function setPontuacaoLimite($input){$this->pontuacaolimite = $input;}
	public function setMultiplicador(Multiplicador $input){$this->multiplicador = $input;}

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'categoria' => $this->getCategoria(),
            'descricao' => $this->getDescricao(),
            'pontuacao' => $this->getPontuacao(),
            'limitePontos' => $this->getPontuacaoLimite(),
            'pontuacaoRef' => $this->getPontuacaoReferencia(),
            'multiplicador' => $this->getMultiplicador()
        ];
    }

}

?>
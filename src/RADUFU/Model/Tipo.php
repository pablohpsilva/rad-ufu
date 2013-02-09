<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Tipo implements JsonSerializable{
	private $id;
	private $categoria;
	private $descricao;
	private $pontuacao;
	private $pontuacaoreferencia;
	private $pontuacaolimite;

	/* GETTERS */
	public function getId(){ return $this->id; }
	public function getCategoria(){ return $this->categoria; }
	public function getDescricao(){ return $this->descricao; }
	public function getPontuacao(){ return $this->pontuacao; }
	public function getPontuacaoReferencia(){ return $this->pontuacaoreferencia; }
	public function getPontuacaoLimite(){ return $this->pontuacaolimite; }

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setCategoria($input){$this->categoria = $input;}
	public function setDescricao($input){$this->descricao = $input;}
	public function setPontuacao($input){$this->pontuacao = $input;}
	public function setPontuacaoReferencia($input){$this->pontuacaoreferencia = $input;}
	public function setPontuacaoLimite($input){$this->pontuacaolimite = $input;}

	public function JsonSerialize() {
        return [
            'uri' => 'tipo/' . $this->getId(),
            'categoria' => $this->getCategoria(),
            'descricao' => $this->getDescricao(),
            'pontuacao' => $this->getPontuacao(),
            'pontuacaoreferencia' => $this->getPontuacaoReferencia(),
            'pontuacaolimite' => $this->getPontuacaoLimite()
        ];
    }

}

?>
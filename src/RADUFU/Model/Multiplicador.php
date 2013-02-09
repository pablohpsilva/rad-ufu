<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Multiplicador implements JsonSerializable{
	private $id;
	private $nome;
	private $valor;
	private $limite;
	private $tipoatividade;

	/* GETTERS */
	public function getId(){ return $this->id;}
	public function getNome(){ return $this->nome;}
	public function getValor(){ return $this->valor;}
	public function getLimite(){ return $this->limite;}
	public function getTipoAtividade(){ return $this->tipoatividade;}

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setNome($input){$this->nome = $input;}
	public function setValor($input){$this->valor = $input;}
	public function setLimite($input){$this->limite = $input;}
	public function setTipoAtividade($input){$this->tipoatividade = $input;}

	public function JsonSerialize() {
        return [
            'uri' => 'multiplicador/' . $this->getId(),
            'nome' => $this->getNome(),
            'valor' => $this->getValor(),
            'limite' => $this->getLimite(),
            'tipoatividade' => $this->getTipoAtividade()
        ];
    }
}

?>
<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Multiplicador implements JsonSerializable{
	private $id;
	private $nome;
	private $valor;

	/* GETTERS */
	public function getId(){ return $this->id;}
	public function getNome(){ return $this->nome;}
	public function getValor(){ return $this->valor;}

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setNome($input){$this->nome = $input;}
	public function setValor($input){$this->valor = $input;}

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'valor' => $this->getValor()
        ];
    }
}

?>
<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Multiplicador implements JsonSerializable{
	private $id;
	private $nome;

	/* GETTERS */
	public function getId(){ return $this->id;}
	public function getNome(){ return $this->nome;}

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setNome($input){$this->nome = $input;}

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome()
        ];
    }
}

?>
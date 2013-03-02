<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Comprovante implements JsonSerializable{
	private $id;
	private $arquivo;
	private $nome;

	/* GETTERS */
	public function getId(){ return $this->id; }
	public function getArquivo(){ return $this->arquivo; }
	public function getNome(){ return $this->nome; }

	/* SETTERS */
	public function setId($input){ $this->id = $input; }
	public function setArquivo($input){ $this->arquivo = $input; }
	public function setNome($input){ $this->nome = $input; }

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'arquivo' => $this->getArquivo()
        ];
    }
}

?>
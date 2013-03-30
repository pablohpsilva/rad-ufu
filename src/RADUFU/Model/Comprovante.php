<?php

namespace RADUFU\Model;

use \JsonSerializable;

class Comprovante implements JsonSerializable{
	private $id = null;
	private $arquivo;

	/* GETTERS */
	public function getId(){ return $this->id; }
	public function getArquivo(){ return $this->arquivo; }

	/* SETTERS */
	public function setId($input){ $this->id = $input; }
	public function setArquivo($input){ $this->arquivo = $input; }

	public function separaNome(){
		$aux = explode("/",$this->getArquivo());
		return array_pop($aux);
	}

	public function separaCaminho(){
		$aux = self::separaNome();
		return explode("/".$aux,$this->getArquivo())[0];
	}

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->separaNome(),
            'arquivo' => $this->separaCaminho()
        ];
    }
}

?>
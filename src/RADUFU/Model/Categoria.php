<?php
namespace RADUFU\Model;

use \JsonSerializable;

class Categoria implements JsonSerializable{
	private $id;
	private $nome;

	/*GETTERS*/
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }

	/*SETTERS*/
	public function setId($n){$this->id = $n;}
	public function setNome($n){$this->nome = $n;}

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome()
        ];
    }
}

?>
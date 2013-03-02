<?php

namespace RADUFU\Model;

use \JsonSerializable,
	RADUFU\util\LazyDelCollection;

class Professor implements JsonSerializable{
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $siape;
	private $atividade;

	public function __construct(){
		$this->atividade = new LazyDelCollection();
	}

	/* GETTERS */
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }
	public function getUsuario(){ return $this->usuario; }
	public function getSenha(){ return $this->senha; }
	public function getSiape(){ return $this->siape; }
	public function getAtividade(){ return $this->atividade; }

	/* SETTERS */
	public function setId($input){$this->id = $input;}
	public function setNome($input){$this->nome = $input;}
	public function setUsuario($input){$this->usuario = $input;}
	public function setSenha($input){$this->senha = $input;}
	public function setSiape($input){$this->siape = $input;}
	public function addAtividade($input){$this->atividade->add($input);}
	public function removeAtividade($input){$this->atividade->remove($input);}

	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'login' => $this->getUsuario(),
            'senha' => $this->getSenha(),
            'siape' => $this->getSiape(),
            'atividades' => $this->getAtividade()
        ];
    }

}

?>
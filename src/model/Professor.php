<?php

//namespace model;

class Professor{
	private $siape;
	private $ativo = true; //DEFAULT true. -- true-ativo; false-inativo
	private $nome;
	private $sobrenome;
	private $usuario;
	private $senha;

	/* GETTERS */
	public function getSiape(){ return $this->siape; }
	public function getAtivo(){ return $this->ativo; }
	public function getNome(){ return $this->nome; }
	public function getSobrenome(){ return $this->sobrenome; }
	public function getUsuario(){ return $this->usuario; }
	public function getSenha(){ return $this->senha; }

	/* SETTERS */
	public function setSiape($si){$this->siape = $si;}
	public function setAtivo($a){$this->ativo = $a;}
	public function setNome($n){$this->nome = $n;}
	public function setSobrenome($sn){$this->sobrenome = $sn;}
	public function setUsuario($u){$this->usuario = $u;}
	public function setSenha($se){$this->senha = $se;}

}

?>
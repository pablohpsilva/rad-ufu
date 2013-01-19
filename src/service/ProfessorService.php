<?php

require_once(__DIR__.'/../DAO/postgres/ProfessorDAO.php');

class ProfessorService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new ProfessorDAO();
	}

	public function createObject($nome, $sobrenome, $usuario, $senha, $ativo = TRUE){
		$this->obj = new Professor();
		$this->obj->setNome($nome);
		$this->obj->setSobrenome($sobrenome);
		$this->obj->setUsuario($usuario);
		$this->obj->setSenha($senha);
		$this->obj->setAtivo($ativo);
		return $this->obj;
	}

	public function get($input){
		if(is_numeric($input))
			return $this->dao->get($input);
		else
			return $this->dao->read($input);
	}

	public function post($nome, $sobrenome, $usuario, $senha){
		$this->dao->post(self::createObject($nome, $sobrenome, $usuario, $senha, $ativo = TRUE));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input)->JsonSerialize();
	}

	public function searchAll(){
		$jsonArray = array();
		foreach ($this->dao->getAll() as $val) {
			$jsonArray[] = $val->JsonSerialize();
		}
		return $jsonArray;
	}

	public function update($idUsuario, $campo, $modificacao){
		$this->obj = self::get($idUsuario);
		switch (strtolower($campo)) {
			case 'nome':
				$this->obj->setNome($modificacao);
				break;
			case 'sobrenome':
				$this->obj->setSobrenome($modificacao);
				break;
			case 'senha':
				$this->obj->setSenha($modificacao);
				break;
			
			default:
				$this->obj->setAtivo($modificacao);
				break;
		}
		$this->dao->update($this->obj);
		unset($this->object);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>
<?php
namespace RADUFU\Service;

use RADUFU\DAO\postgres\ProfessorDAO,
    RADUFU\Model\Professor;

/*
require_once(__DIR__.'/../DAO/postgres/ProfessorDAO.php');
*/

class ProfessorService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new ProfessorDAO();
	}

	public function createObject($siape, $nome, $sobrenome, $usuario, $senha, $ativo = TRUE){
		$this->obj = new Professor();
		$this->obj->setId($siape);
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

	public function post($siape, $nome, $sobrenome, $usuario, $senha){
		$this->dao->post(self::createObject($siape, $nome, $sobrenome, $usuario, $senha, $ativo = TRUE));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll(){
		return $this->dao->getAll();
	}

	public function update($idUsuario, $campo, $modificacao){
		$this->obj = self::search($idUsuario);
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
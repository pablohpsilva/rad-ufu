<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\ProfessorDAO,
    RADUFU\Model\Professor;

class ProfessorService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getProfessorDAO();
	}

	public function createObject($id = null, $siape, $nome, $senha){
		$this->obj = new Professor();
		$this->obj->setId($id);
		$this->obj->setNome($nome);
		$this->obj->setSiape($siape);
		$this->obj->setSenha($senha);
		return $this->obj;
	}

	public function get($input){
		if(is_numeric($input))
			return $this->dao->get($input);
		else
			return $this->dao->read($input);
	}

	public function post($siape, $nome, $senha){
		$this->dao->post(self::createObject(null, $siape, $nome, $senha));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll(){
		return $this->dao->getAll();
	}

	public function update($id, $siape, $nome, $senha){
		//Tenho tudo que preciso para atualizar um objeto. Crio um objeto novo
		self::createObject($id, $siape, $nome, $senha);
		//Atualizo ele aqui, afinal, tenho o seu ID, e isso e o que interessa.
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>
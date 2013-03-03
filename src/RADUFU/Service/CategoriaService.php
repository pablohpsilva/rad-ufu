<?php
namespace RADUFU\Service;

use RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\CategoriaDAO,
    RADUFU\Model\Categoria;

class CategoriaService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = Factory::getFactory(Factory::PGSQL)->getCategoriaDAO();
	}

	private function createObject($input){
		$this->obj = new Categoria();
		$this->obj->setNome($input);
		return $this->obj;
	}

	public function get($input){
		if(is_numeric($input))
			return $this->dao->get($input);
		else
			return $this->dao->read($input);
	}

	public function post($input){
		$this->dao->post(self::createObject($input));
		unset($this->obj);
	}

	public function search($input){
		return self::get($input);
	}

	public function searchAll(){
		return $this->dao->getAll();
	}
	
	public function update($id, $nome){
		self::createObject($nome);
		$this->obj->setId($id);
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>
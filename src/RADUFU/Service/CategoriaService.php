<?php
namespace RADUFU\Service;

use RADUFU\DAO\postgres\CategoriaDAO,
    RADUFU\Model\Categoria;
/*
require_once(__DIR__.'/../DAO/postgres/CategoriaDAO.php');
*/
class CategoriaService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new CategoriaDAO();
	}

	public function createObject($input){
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
		$jsonArray = array();
		foreach ($this->dao->getAll() as $val) {
			$jsonArray[] = $val;
		}
		return $jsonArray;
	}

	public function update($id, $input){
		$this->obj = self::get($id);
		$this->obj->setNome($input);
		$this->dao->update($this->obj);
		unset($this->obj);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>
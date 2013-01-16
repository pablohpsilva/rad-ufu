<?php

require_once(__DIR__.'/../DAO/postgres/CategoriaDAO.php');

class CategoriaService{
	private $dao;
	private $obj;

	public function __construct(){
		$this->dao = new CategoriaDAO();
		$this->obj = new Categoria();
	}

	public function createObject($input){
		$this->setName($input);
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
			return self::get($input)->JsonSerialize();
	}

	public function searchAll(){
		$jsonArray() = array();
		foreach ($this->dao->getAll() as $val) {
			$jsonArray[] = $val->JsonSerialize();
		}
		return jsonArray;
	}

	public function update($id, $input){
		$this->dao->update(self::get($id)->setName($input));
	}

	public function delete($input){
		$this-dao->delete($input);
	}

}

?>